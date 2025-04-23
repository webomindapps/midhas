<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Models\CustomerPasswordResets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class PasswordResetController extends Controller
{
    public function Forgetpassword()
    {
        return view('frontend.auth.forgot-password');
    }
    public function forgetMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $email = $request->email;
        $token = Str::random(64);
        CustomerPasswordResets::create([
            'email' => $email,
            'token' => $token,
            'created_at' => now(), 

        ]);
        $customer = User::where('email', $email)->first();
        Mail::to($email)->send(new ForgotPasswordMail($customer, $token));
        return back()->with('message', 'Password reset mail sent to your email address');
    }

    public function resetView($token)
    {
        return view('frontend.auth.password-reset', compact('token'));
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ], [
            'confirm_password.same' => 'Password and confirm password should be same',
            'confirm_password.required' => 'Confirm password field is required',
        ]);
        $token = CustomerPasswordResets::where('token', $request->reset_token)->first();

        if (is_null($token)) {
            return back()->with('error', 'Token mismatch');
        } else {
            $customer = User::where('email', $request->email)->first();
            $customer->update([
                'password' => Hash::make($request->password)
            ]);
        }
        return redirect()->route('customer.login')->with('message', 'Password reseted successfully');
    }
}
