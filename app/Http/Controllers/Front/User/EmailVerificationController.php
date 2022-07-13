<?php

namespace App\Http\Controllers\Front\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;

class EmailVerificationController extends Controller
{
    /**
     * Verify a user's email
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function __invoke(Request $request)
    {
        auth()->loginUsingId($request->route('id'));

        if (!hash_equals(
            (string) $request->route('id'),
            (string) $request->user()->getKey()
        )) {
            abort(404);
        }

        if (!hash_equals(
            (string) $request->route('hash'),
            sha1($request->user()->getEmailForVerification())
        )) {
            abort(404);
        }


        if ($request->user()->hasVerifiedEmail()) {
            return view("front.auth.email-was-verified");
        } else {
            $request->user()->markEmailAsVerified();
            event(new Verified($request->user()));
            
            return view('front.auth.dashboard');
        }
    }
}
