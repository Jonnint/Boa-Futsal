<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'subject' => 'required|string|max:150',
            'message' => 'required|string',
            'type'    => 'required|in:general,collab',
        ]);

        ContactMessage::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'type'    => $request->type,
        ]);

        if ($request->type === 'collab') {
            return back()->with('collab_success', 'Pesan collab/sponsorship kamu berhasil dikirim! Kami akan segera menghubungi kamu.');
        }

        return back()->with('contact_success', 'Komentar kamu berhasil dikirim!');
    }

    public function publicComments()
    {
        $comments = ContactMessage::where('type', 'general')
            ->orderBy('created_at', 'desc')
            ->get(['name', 'message', 'created_at']);

        return response()->json($comments);
    }
}
