<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function home(): Response
    {
        return Inertia::render('Home');
    }

    public function about(): Response
    {
        return Inertia::render('About');
    }

    public function contact(): Response
    {
        return Inertia::render('Contact');
    }

    public function contactStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'company' => ['nullable', 'string', 'max:255'],
            'subject' => ['required', 'string', 'in:general,services,partnership,other'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        // TODO: Send email or store in CRM. For now we just redirect with success.
        return redirect()->route('contact')->with('success', true);
    }

    public function services(): Response
    {
        return Inertia::render('Services');
    }

    public function privacy(): Response
    {
        return Inertia::render('Privacy');
    }
}
