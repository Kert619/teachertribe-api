<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class GetUserController extends Controller
{
    use HttpResponses;
    public function __invoke(Request $request)
    {
        return $this->success($request->user());
    }
}
