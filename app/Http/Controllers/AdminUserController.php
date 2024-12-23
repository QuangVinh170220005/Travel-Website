<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class AdminUserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.userManagement', compact(var_name: 'users'));
    }

    public function showInfor($user_id){
       try{
        $user = User::findOrFail($user_id);
       if (request()->ajax()) {
            return view('admin.editUser', compact('user'))->render();
        }
       }catch(\Exception $e){
        return redirect()->route('userManagement')
            ->with('error', 'User not found with ID: ' . $user_id);
       }
    }
    
    public function delete(User $user){
        try {
            // Kiểm tra xem user có vai trò ADMIN không
            if ($user->role === 'ADMIN') {
                return redirect()->back()->with('error', 'Cannot delete admin accounts.');
            }
    
            // Tiến hành xóa nếu không phải ADMIN
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        } catch(\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage()); 
            return redirect()->back()->with('error', 'Error occurred while deleting user.');
        }
    }
    

    public function update(Request $request, $user_id){
        $user = User::findOrFail($user_id);

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user_id.',user_id',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|max:2048'
        ]);
        
        // cập nhập thông tin
        $user -> full_name = $request -> full_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        $user->update([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address']
        ]);
        Log::info('User updated successfully', [
            'user_id' => $user_id,
            'updated_by' => Auth::id()
        ]);
        return redirect()->route('userManagement', $user->user_id)
            ->with('success', 'User information updated successfully');
    }


    // Thêm tài khoản người dùng
    public function create()
    {
        return view('admin.createUser');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'role' => 'required|in:,ADMIN,CUSTOMER'
        ]); 

        $user = User::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'role' => $validated['role']
        ]);

        return redirect()->route('userManagement')
            ->with('success', 'User created successfully');
    }

}
