<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\VerificationMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function index()
    {
        return view('frontend.auth.login');
    }
    public function signup()
    {
        return view('frontend.auth.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|same:conf_password',
        ]);

        // Create the user and log them in
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($user) {
            Mail::to($user->email)->send(new VerificationMail($user));
        }
        return redirect()->route('customer.login')->with('success', 'User Registered Sucessfully');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if (is_null($user->email_verified_at)) {
                Auth::logout();
                return back()->with('danger', 'Your account is not verified. Please check your email to verify your account.');
            }

            return redirect()->intended('dashboard')->with('success', 'Logged in successfully.');
        } else {
            return back()->with('danger', 'Invalid credentials. Please try again.');
        }
    }

    public function verify()
    {
        return view('frontend.auth.email-verify');
    }

    public function verifyEmail(Request $request)
    {
        $customer = User::where('email', $request->email)->first();
        $customer->email_verified_at = Carbon::now();
        $customer->save();
        return redirect()->route('customer.login');
    }

    
}
