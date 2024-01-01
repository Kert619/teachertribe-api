<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssessmentExamineeRequest;
use App\Http\Resources\AssessmentExamineeResource;
use App\Models\AssessmentExaminee;
use App\Models\Examinee;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class AssessmentExamineeController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'assessment_id' => ['required'],
        ]);

        $assessmentExaminees = AssessmentExaminee::with(['assessment', 'examinee', 'group'])->where('assessment_id', $request->assessment_id)->get();
        return AssessmentExamineeResource::collection($assessmentExaminees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssessmentExamineeRequest $request)
    {
        $request->validated($request->all());

        foreach ($request->examinees as $examinee) {
            $newExaminee = Examinee::create([
                'first_name' => $examinee['first_name'],
                'last_name' => $examinee['last_name'],
                'email' => $examinee['email'],
                'contact' => $examinee['contact'],
            ]);

            AssessmentExaminee::create([
                'assessment_id' => $request->assessment_id,
                'examinee_id' => $newExaminee->id,
                'pin' => $this->generatePin(8),
                'test_mode' => $examinee['test_mode'],
                'group_id' => $examinee['group_id'],
                'schedule_from' => $examinee['schedule_from'],
                'schedule_to' => $examinee['schedule_to'],
            ]);
        }

        return $this->success(null, 'Examinees successfully added and invited', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AssessmentExaminee $assessmentExaminee)
    {
        //
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
    public function destroy(Request $request, AssessmentExaminee $assessmentExaminee)
    {
        //
    }

    private function generatePin($length)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $pin = '';

        for ($i = 0; $i < $length; $i++) {
            $pin .= $characters[rand(0, $charactersLength - 1)];
        }

        return $pin;
    }
}
