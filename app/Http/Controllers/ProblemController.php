<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProblemRequest;
use App\Http\Resources\ProblemResource;
use App\Models\Problem;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $problems = Problem::with(['problemType', 'examType'])->get();
        return ProblemResource::collection($problems);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProblemRequest $request)
    {
        $validated = $request->validated();

        $problem = Problem::create([
            'problem_title' => $validated->problem_title,
            'problem_description' => $validated->problem_description,
            'problem_type_id' => $validated->problem_type_id,
            'difficulty' => $validated->difficulty,
            'duration' => $validated->duration,
            'instructions' => $validated->instructions
        ]);

        return $this->success($problem, 'New problem has been added');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Problem $problem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Problem $problem)
    {
        $problem->delete();
        return $this->success(null, 'Problem has been deleted');
    }
}
