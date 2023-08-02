<?php

use Illuminate\Routing\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Override the username method to use 'StudentID' for students and 'LecturerID' for lecturers
    public function username()
    {
        return request()->is('lecturer/*') ? 'LecturerID' : 'StudentID';
    }

    // Override the showLoginForm method to specify the correct view for each user type
    public function showLoginForm()
    {
        if (request()->is('student/*')) {
            return view('/Login'); // Replace with your student login view
        } elseif (request()->is('lecturer/*')) {
            return view('/Login'); // Replace with your lecturer login view
        }

        return view('/Login'); // Default login view if no user type is specified
    }

    // Override the guard method to use the correct guard based on the request
    protected function guard()
    {
        if (request()->is('student/*')) {
            return Auth::guard('student');
        } elseif (request()->is('lecturer/*')) {
            return Auth::guard('lecturer');
        }

        return Auth::guard('web'); // Default guard if no user type is specified
    }

    // Redirect users after successful login
    protected function redirectTo()
    {
        if (request()->is('student/*')) {
            return '/student/dashboard'; // Replace with the student dashboard route
        } elseif (request()->is('lecturer/*')) {
            return '/lecturer/dashboard'; // Replace with the lecturer dashboard route
        }

        return '/home'; // Default redirect path if no user type is specified
    }

    // Logout the user and redirect to the appropriate login page
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        if (request()->is('student/*')) {
            return redirect('/student/login'); // Replace with the student login route
        } elseif (request()->is('lecturer/*')) {
            return redirect('/lecturer/login'); // Replace with the lecturer login route
        }

        return redirect('/login'); // Default login route if no user type is specified
    }
}