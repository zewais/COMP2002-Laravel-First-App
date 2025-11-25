<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $incomingData = $request->validate([
            'name' => ['required','string', 'max:255', Rule::unique('users','name')],
            'email' => ['required','email', Rule::unique('users','email')],
            'password' => ['required','string','min:3', 'max:255'],
        ]);
        $incomingData['password'] = bcrypt($incomingData['password']);
        $user = User::create($incomingData); //this will return an instance of the created user

        auth()->login($user); //log in the user after registration

        // Handle the registration logic here
        return redirect('/');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'loginName' => ['required','string'],
            'loginPassword' => ['required','string'],
        ]);

        if (auth()->attempt([
            'name' => $credentials['loginName'],
            'password' => $credentials['loginPassword'],
        ])) {
            $request->session()->regenerate(); //prevent session fixation attacks 
            // Authentication passed...
            return redirect()->intended('/'); //redirect to intended page or home
        }

        return redirect('/')->withErrors([
            'loginError' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout(); //log out the user
        return redirect('/'); //redirect to home page after logout
    }
}
