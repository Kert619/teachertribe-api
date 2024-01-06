<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Http\Resources\AnswerResource;
use App\Models\Answer;
use App\Models\AssessmentExaminee;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate(['assessment_examinee_id' => ['required']]);

        $answers = Answer::with(['assessmentExaminee', 'problem', 'assessmentExaminee.assessment', 'assessmentExaminee.examinee'])->where('assessment_examinee_id', $request->assessment_examinee_id)->get();

        return AnswerResource::collection($answers);
    }

    public function submitAnswer(StoreAnswerRequest $request)
    {
        $request->validated($request->all());

        $answer = Answer::where('assessment_examinee_id', $request->assessment_examinee_id)->where('problem_id', $request->problem_id)->first();

        if ($answer) {
            $answer->update([
                'answer' => $request->answer,
                'score_attained' => $request->score_attained,
                'total_score' => $request->total_score,
            ]);

            $answer->load(['assessmentExaminee', 'problem', 'assessmentExaminee.assessment', 'assessmentExaminee.examinee']);

            return $this->success(new AnswerResource($answer), 'Answer has been updated');
        } else {
            $answer = Answer::create([
                'assessment_examinee_id' => $request->assessment_examinee_id,
                'problem_id' => $request->problem_id,
                'answer' => $request->answer,
                'score_attained' => $request->score_attained,
                'total_score' => $request->total_score,
            ]);

            $answer->load(['assessmentExaminee', 'problem', 'assessmentExaminee.assessment', 'assessmentExaminee.examinee']);

            return $this->success(new AnswerResource($answer), 'New answer has been added');
        }
    }

    public function getByAssessmentExamineeIdAndProblemId(Request $request)
    {
        $request->validate([
            'assessment_examinee_id' => ['required'],
            'problem_id' => ['required'],
        ]);

        $answer = Answer::with(['assessmentExaminee', 'problem', 'assessmentExaminee.assessment', 'assessmentExaminee.examinee'])->where('assessment_examinee_id', $request->assessment_examinee_id)->where('problem_id', $request->problem_id)->first();

        return $this->success($answer ?? null);
    }

    public function show(AssessmentExaminee $assessmentExaminee){
        $answers = Answer::with(['assessmentExaminee', 'problem', 'assessmentExaminee.assessment', 'assessmentExaminee.examinee'])->where('assessment_examinee_id', $assessmentExaminee->id)->get();
        return AnswerResource::collection($answers);
    }
}
