<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use HttpResponses;
    public function __invoke(LoginRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return $this->error('Invalid username or password', 400);
        }

        return $this->success([
            'token' => $request->user()->createToken('API TOKEN OF ' . $request->user()->name)->plainTextToken,
        ], 'Login was successful');
    }
}
