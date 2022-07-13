<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\Auth\ChangePasswordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ChangePasswordRequest $request)
    {
        $user = User::find($request->user()->id);

        if (!Hash::check($request->safe()->current_password, $user->password)) {
            return response(['message' => 'The current password is not correct.'], 401);
        }

        $user->update($request->data());

        return response(['message' => 'The password has been successfully changed.']);
    }
}
