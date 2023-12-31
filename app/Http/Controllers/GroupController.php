<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $groups = Group::with(['user'])->whereBelongsTo($request->user())->get();
        return GroupResource::collection($groups);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'group_name' => ['required']
       ]);

      $newGroup = Group::create([
        'group_name' => $request->group_name,
        'user_id' => $request->user()->id,
       ]);

       return $this->success(New GroupResource($newGroup), 'New group has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Group $group)
    {
        if ($request->user()->id === $group->user_id) {
            $group->load(['users']);
            return new GroupResource($group);
        } else {
            return $this->error('Group not found', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Group $group)
    {
        if ($request->user()->id === $group->user_id) {
            $group->delete();
            return $this->success(null, 'Group has been deleted');
        } else {
            return $this->error("You cannot delete other user's group", 403);
        }
    }
}
