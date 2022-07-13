<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Models\ResetCodePassword;
use App\Mail\SendCodeResetPassword;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordController extends Controller
{
    /**
     * Send random code to email of user to reset password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ForgetPasswordRequest $request)
    {
        ResetCodePassword::where('email', $request->email)->delete();

        $codeData = ResetCodePassword::create($request->data());

        Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code));

        return response(['message' => 'The code has been sent to your email.']);
    }
}
