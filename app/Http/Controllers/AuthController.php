<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    //
    public function showLoginForm() {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin');
            }
            return redirect()->intended('/home');
        }
        return view('auth.login');
    }
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        Log::info('Attempting login for email: ' . $credentials['email']);
        
        // Thêm tham số remember vào Auth::attempt()
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            
            if (Auth::user()->role === 'ADMIN') {
                return redirect()->intended('/admin');
            }
            return redirect()->intended('/home');
        }
        Log::error('Login failed for email: ' . $credentials['email']);
    
        return back()->withErrors([
            'email' => 'Thông tin xác thực không khớp',
        ])->withInput($request->only('email'));
    }    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function register(Request $request){
        $request->validate([
            'full_name' => 'required|max:100',
            'email' => 'required|email|unique:users|max:100',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'full_name'=> $request -> full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=>'CUSTOMER'
        ]);
        // Auth::login($user);
        return redirect()->route('login')->with('success', 'Đăng ký thành công');
    }
}
