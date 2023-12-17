<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    use HttpResponses;

    public function __invoke(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->success(null, 'Logout was successful');
    }
}
