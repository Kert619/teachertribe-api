<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class UpdateUserController extends Controller
{
    use HttpResponses;
    public function __invoke(UpdateUserRequest $request, User $user)
    {
        $request->validated($request->all());

        if($request->user()->id === $user->id){
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            return $this->success($user, "User profile has been updated");
        } else{
            return $this->error('You are not authorized to perform this action', 403);
        }
    }
}
