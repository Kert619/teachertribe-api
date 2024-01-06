<?php

namespace App\Http\Controllers;

use App\Http\Resources\AssessmentExamineeResource;
use App\Http\Resources\ExamineeResource;
use App\Models\AssessmentExaminee;
use App\Models\Examinee;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UpdateExamineeDetailsController extends Controller
{
    use HttpResponses;
    public function __invoke(Request $request)
    {
        $request->validate([
            'examinee_id' => ['required'],
            'programming_experience' => ['required']
        ]);

        $examinee = Examinee::find($request->examinee_id);
        $examinee->update([
            'last_school_attended' => $request->last_school_attended,
            'degree' => $request->degree,
            'field_of_study' => $request->field_of_study,
            'programming_experience' => $request->programming_experience,
        ]);

        $assessmentExaminee = AssessmentExaminee::with(['assessment', 'examinee', 'group', 'assessment.problems', 'assessment.problems.problemType', 'assessment.problems.problemType.examType'])->where('pin', $request->pin)->firstOrFail();
        $assessmentExaminee->update([
            'started_on' => Carbon::now(),
            'status' => 'On-Going'
        ]);

        return $this->success(new AssessmentExamineeResource($assessmentExaminee), 'Examinee details has been updated');
    }
}
