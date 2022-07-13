<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\Auth\ResetPasswordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ResetPasswordRequest $request)
    {
        $passwordReset = ResetCodePassword::firstWhere('code', $request->safe()->code);

        if ($passwordReset->isExpire()) {
            return response(['message' => 'This code is expired.'], 422);
        }

        $user = User::firstWhere('email', $passwordReset->email);
        $user->update($request->data());

        ResetCodePassword::Where('code', $request->code)->delete();

        return response(['message' => 'The password has been successfully changed.']);
    }
}
