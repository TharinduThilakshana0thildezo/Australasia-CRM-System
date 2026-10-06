<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // If already logged in, redirect to dashboard
        if (session()->has('auth_user')) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Hardcoded credentials as requested for the prototype
        if ($request->email === 'admin@australasia.lk' && $request->password === 'password') {
            session([
                'auth_user' => [
                    'name' => 'Senaka Karunaratne',
                    'email' => 'admin@australasia.lk',
                    'role' => 'Director'
                ]
            ]);
            
            return redirect()->route('dashboard');
        }

        return back()->withInput($request->only('email'))->with('error', 'Invalid email or password.');
    }

    public function logout(Request $request)
    {
        session()->forget('auth_user');
        session()->flush();
        
        return redirect()->route('login');
    }
}
