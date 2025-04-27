<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Models\CustomerPasswordResets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
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
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
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
