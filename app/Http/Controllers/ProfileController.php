<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        // Thêm các dữ liệu khác nếu cần, ví dụ như booking history
        // $bookings = $user->bookings()->latest()->take(5)->get();
        
        return view('profile.index', compact('user', 'bookings'));
    }

    // public function edit()
    // {
    //     return view('profile.edit', [
    //         'user' => Auth::user()
    //     ]);
    // }

    // public function update(Request $request)
    // {
    //     $user = Auth::user();

    //     $validated = $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'bio' => ['nullable', 'string', 'max:1000'],
    //         'phone' => ['nullable', 'string', 'max:20'],
    //         'address' => ['nullable', 'string', 'max:255'],
    //         'avatar' => ['nullable', 'image', 'max:1024'], // Max 1MB
    //         'social_links' => ['nullable', 'array'],
    //         'social_links.facebook' => ['nullable', 'url'],
    //         'social_links.twitter' => ['nullable', 'url'],
    //         'social_links.instagram' => ['nullable', 'url'],
    //     ]);

    //     // Xử lý upload avatar
    //     if ($request->hasFile('avatar')) {
    //         // Xóa avatar cũ nếu có
    //         if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
    //             Storage::disk('public')->delete($user->avatar);
    //         }

    //         $path = $request->file('avatar')->store('avatars', 'public');
    //         $validated['avatar'] = $path;
    //     }

    //     $user->update($validated);

    //     return redirect()->route('profile')->with('success', 'Profile updated successfully');
    // }

    // public function deleteAvatar()
    // {
    //     $user = Auth::user();
        
    //     if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
    //         Storage::disk('public')->delete($user->avatar);
    //     }

    //     $user->update(['avatar' => null]);

    //     return redirect()->back()->with('success', 'Avatar removed successfully');
    // }

    // public function bookings()
    // {
    //     $bookings = Auth::user()->bookings()->paginate(10);
    //     return view('profile.bookings', compact('bookings'));
    // }

    // public function reviews()
    // {
    //     $reviews = Auth::user()->reviews()->with('tour')->paginate(10);
    //     return view('profile.reviews', compact('reviews'));
    // }
}
