<?php

use Illuminate\Routing\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Override the username method to use 'StudentID' for students and 'LecturerID' for lecturers
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;
    

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

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Store user data in the session
            session()->put('user', $user);

            // Redirect to the appropriate dashboard based on the user's role
            if ($user->role === 'student') {
                return redirect()->route('student.dashboard');
            } elseif ($user->role === 'lecturer') {
                return redirect()->route('lecturer.dashboard');
            } elseif ($user->role === 'aaro') {
                return redirect()->route('aaro.dashboard');
            }
        }

        // If authentication fails, redirect back with an error message
        return redirect()->route('login')->with('error', 'Invalid credentials.');
    }
    public function logout()
    {
        // Clear the user data from the session
        session()->forget('user');

        // Logout the user using Laravel's built-in logout method
        Auth::logout();

        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}