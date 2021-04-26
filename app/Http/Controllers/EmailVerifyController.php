<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerifyController extends Controller
{
    public function notice()
    {
        return view('auth.verify');
    }

    public function verifyEmail(EmailVerificationRequest $EmailVerificationRequest)
    {
        $EmailVerificationRequest->fulfill();
        return redirect('/home');
    }

    public function verifySend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
