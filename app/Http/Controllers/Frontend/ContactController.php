<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'company' => 'nullable|string|max:255',
            'service' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
            'type' => 'required|in:contact,quote',
        ]);

        ContactRequest::create($validated);

        $locale = app()->getLocale();

        return redirect("/{$locale}/bedankt");
    }

    public function storeQuote(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'company' => 'nullable|string|max:255',
            'service' => 'required|string|max:255',
            'surface' => 'nullable|string|max:50',
            'frequency' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'urgency' => 'nullable|string|max:100',
            'message' => 'nullable|string|max:5000',
        ]);

        $validated['type'] = 'quote';
        $validated['message'] = $validated['message'] ?? '';

        ContactRequest::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'company' => $validated['company'] ?? null,
            'service' => $validated['service'],
            'message' => "Surface: {$validated['surface']}m² | Frequentie: {$validated['frequency']} | Locatie: {$validated['location']} | Urgentie: {$validated['urgency']} | {$validated['message']}",
            'type' => 'quote',
        ]);

        $locale = app()->getLocale();

        return redirect("/{$locale}/bedankt");
    }
}
