<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

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

        $user = User::where($request->validated())->first();

        if (!$user) {
            return response(['message' => 'Unauthorized'], 401);
        }

        $ability = $user->hasVerifiedEmail() ? 'user-confirmed' : 'user-unconfirmed';
        $token = $user->createToken(time(), [$ability])->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}
