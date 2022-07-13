<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Login a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return response(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request->safe()->email)->first();

        $ability = $user->hasVerifiedEmail() ? 'user-confirmed' : 'user-unconfirmed';
        $token = $user->createToken(time(), [$ability])->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}
