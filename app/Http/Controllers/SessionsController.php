<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class SessionsController extends Controller
{
    //show form for creating new resource

    public function create()
    {
        return view('auth.login');
    }

    // store new created resource in storage
    public function store(Request $request)
    {
        // validate
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', Password::default()],
        ]);

        // attempt login
        if (Auth::attempt($validated)) {
            $request->session()->regenerate(); //recycling stored tokens when logging in to prevent hijacking
            return redirect('/ideas');
        }
        // redirect
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // remove specified resource from storage
    public function destroy()
    {
        Auth::logout();

        return redirect('/ideas');
    }
}
