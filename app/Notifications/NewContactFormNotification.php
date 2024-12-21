<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function store(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required'
        ]);

        try {
            // Create new contact form entry
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