<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('Login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'userID' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find the user by userID
        $user = User::where('userID', $credentials['userID'])->first();

        // Check if the user exists and the password matches
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Store user data in the session
            session()->put('user', $user);

            // Redirect to the appropriate dashboard based on the user's role
            if ($user->role === 'student') {
                return redirect()->route('student.dashboard');
            } elseif ($user->role === 'lecturer') {
                return redirect()->route('lecturer.dashboard');
            } elseif ($user->role === 'AARO') {
                return redirect()->route('student.index');
            }
        }

        // If authentication fails, redirect back with an error message
        return redirect()->route('login')->with('error', 'Invalid credentials.');
    }
    public function logout()
    {
        // Logout the user using Laravel's built-in logout method
        Auth::logout();
        Session::flush();
        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
