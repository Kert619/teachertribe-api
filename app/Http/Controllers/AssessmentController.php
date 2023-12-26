<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssessmentRequest;
use App\Http\Resources\AssessmentResource;
use App\Models\Assessment;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page ?? 10;
        $assessments = Assessment::with(['problems'])->whereBelongsTo($request->user())->paginate($perPage);
        return AssessmentResource::collection($assessments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssessmentRequest $request)
    {
        $request->validated($request->all());
        
        $assessment = Assessment::create([
            'assessment_title' => $request->assessment_title,
            'description' => $request->description,
            'time_restriction' => $request->time_restriction,
            'setup_time' => $request->setup_time,
            'window_proctor' => $request->window_proctor,
            'randomize' => $request->randomize,
            'user_id' => $request->user()->id,
        ]);

        $assessment->problems()->attach($request->problem_ids, ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);

        $assessment->load(['problems']);
        return $this->success(new AssessmentResource($assessment), 'New assessment has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Assessment $assessment)
    {
        if ($request->user()->id === $assessment->user_id) {
            $assessment->load(['problems']);
            return new AssessmentResource($assessment);
        } else {
            return $this->error('Assessment not found', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Assessment $assessment)
    {
        if ($request->user()->id === $assessment->user_id) {
            $assessment->delete();
            return $this->success(null, 'Assessment has been deleted');
        } else {
            return $this->error("You cannot delete other user's assessment", 403);
        }
    }

    public function checkExistingAssessmentTitle(Request $request){
        $request->validate([
            'assessment_title' => ['required']
        ]);

        $assessment = Assessment::where('assessment_title', $request->assessment_title)->first();

       return $this->success(['isExist' => !!$assessment]);
    }
}
