<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

    // return redirect(RouteServiceProvider::HOME);


    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        $user = Auth::user();
        
        // Custom redirection logic based on user role
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == 'librarian') {
            return redirect()->route('librarian.dashboard');
        } elseif ($user->role == 'student') {
            return redirect()->route('student.dashboard'); // Assuming there's a student dashboard
        } else {
            return redirect()->route('lecturer.dashboard'); // Assuming there's a student dashboard
        }
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
    }
}
