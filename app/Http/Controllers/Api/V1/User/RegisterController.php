<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /**
     * Register a new user
     *
     * @param  \App\Http\Requests\User\RegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        event(new Registered($user));
        $token = $user->createToken(time(), ['user-unconfirmed'])->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}
