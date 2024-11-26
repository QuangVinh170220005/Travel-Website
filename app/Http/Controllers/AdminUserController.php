<?php

namespace App\Http\Controllers;

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
        return view('admin.userManagement', compact('users'));
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
        try{
            // if(Auth::user()->user_id === $user->user_id){
            //     return redirect()->back()->with('error', 'You cannot delete yourself.');
            // }
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        }catch(\Exception $e){
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

        // if ($request->hasFile('avatar')) {
        //     // Xóa avatar cũ nếu có
        //     if ($user->avatar_url) {
        //         Storage::delete('public/avatars/' . $user->avatar_url);
        //     }
            
        //     // Upload avatar mới
        //     $avatarName = time().'.'.$request->avatar->extension();
        //     $request->avatar->storeAs('public/avatars', $avatarName);
        //     $user->avatar_url = $avatarName;
        // }
        
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
    
}
