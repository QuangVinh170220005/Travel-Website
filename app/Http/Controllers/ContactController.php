<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactForm;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Lưu vào database
            ContactForm::create([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Tin nhắn của bạn đã được gửi thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Đã có lỗi xảy ra khi gửi tin nhắn.'
            ], 500);
        }
    }
}
