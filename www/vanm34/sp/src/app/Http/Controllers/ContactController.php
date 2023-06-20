<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $details = [
            'from' => Auth::user()->email,
            'message' => $request->message
        ];
        Mail::to($request->email)->send(new \App\Mail\ContactMail($details));

        return back()->with('success', 'Thanks for contacting us!');
    }

    public function contact()
    {
        $users = User::where('role', 1)->get();
        return view('contact', compact('users'));
    }
}
