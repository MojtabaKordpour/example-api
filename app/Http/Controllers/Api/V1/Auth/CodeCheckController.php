<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CodeCheckRequest;
use App\Models\ResetCodePassword;

class CodeCheckController extends Controller
{
    /**
     * Check if the code is exist and vaild one.
     *
     * @param  \App\Http\Requests\Auth\CodeCheckRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CodeCheckRequest $request)
    {
        $passwordReset = ResetCodePassword::firstWhere('code', $request->safe()->code);

        if ($passwordReset->isExpire()) {
            return response(['message' => 'This code is expired.'], 422);
        }

        return response(['code' => $passwordReset->code]);
    }
}
