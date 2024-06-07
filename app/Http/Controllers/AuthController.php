<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|min:3|max:40',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:8'
            ]
        );

        $slug = Str::slug($validated['name']);


        $user = User::create(
            [
                'name' => $validated['name'],
                'slug' => $slug,
                'email' => $validated['email'],
                'ip_address' => $request->ip(),
                'password' => Hash::make($validated['password']),
            ]
        );
        // dd($user);

        event(new Registered($user));
        // dd($user);
        // $user->notify(new WelcomeEmailNotification($user));
        // Mail::to($user->email)
        //     ->send(new WelcomeEmail());
        Alert::success('Success','Account created Successfully!' );

        return redirect()->route('dashboard');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate()
    {
        $validated = request()->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]
        );

        if (auth()->attempt($validated)) {
            request()->session()->regenerate();

            Alert::success('Success','Logged in successfully!' );

            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->withErrors([
            'email' => "No matching user found with the provided email and password"
        ]);
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        Alert::success('Success','Logged out successfully!' );

        return redirect()->route('dashboard');
    }
}
