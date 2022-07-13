<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenerateTokenController extends Controller
{
    /**
     * Generate new access token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            $request->user()->currentAccessToken()->delete();
            $newAccessToken = $request->user()->createToken(time(), ['user-confirmed'])->plainTextToken;
            return ['token' => $newAccessToken];
        } else {
            return response(['message' => 'The email has not been verified.'], 401);
        }
    }
}
