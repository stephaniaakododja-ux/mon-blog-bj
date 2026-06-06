<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // 1. Afficher la page de contact
    public function show()
    {
        return view('contact');
    }

public function store(Request $request)
{
    $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string|min:10',
    ]);

    Contact::create($request->only(['name', 'email', 'subject', 'message']));

    return redirect()->back()->with('success', 'Votre message a bien été envoyé ! Je vous répondrai très vite. ✨');
}
public function message()
{
    if (!auth()->user()->is_admin) {
        abort(403);
    }

    $message = Contact::latest()->get();
    return view('admin.message', compact('message'));
}
}