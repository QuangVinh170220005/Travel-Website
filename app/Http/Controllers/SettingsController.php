<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        return view('user.settings.index', [
            'user' => Auth::user(),
        ]);
    }

    public function show($section = 'profile')
    {
        // Nếu request là AJAX, trả về partial view
        if (request()->ajax()) {
            try {
                $user = Auth::user();
                return view("user.settings.{$section}", compact('user'));
            } catch (\Exception $e) {
                Log::error('Settings section error: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        // Nếu không phải AJAX request (truy cập trực tiếp hoặc F5)
        // trả về view chính với section được chọn
        return view('user.settings.index', [
            'user' => Auth::user(),
            'currentSection' => $section
        ]);
    }
}
