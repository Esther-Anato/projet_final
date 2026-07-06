<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        // TODO: brancher un vrai envoi mail (Mail::to()->send()) quand ton
        // collègue back-end aura configuré le driver mail. Pour l'instant
        // je stocke rien nulle part, je renvoie juste un succès simulé —
        // à toi de voir si tu veux une table `messages_contact`.

        return back()->with('success', 'Merci ! Votre message a bien été envoyé, nous vous répondons sous 24h.');
    }
}
