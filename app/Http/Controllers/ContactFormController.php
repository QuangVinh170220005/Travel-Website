<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string'
        ]);

        try {
            ContactForm::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Thank you for your message. We will contact you soon!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sorry, there was an error sending your message.'
            ], 500);
        }
    }
}