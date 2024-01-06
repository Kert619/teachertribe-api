<?php

namespace App\Http\Controllers;

use App\Http\Resources\AssessmentExamineeResource;
use App\Models\AssessmentExaminee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerifyPinController extends Controller
{
    //

    public function __invoke(Request $request)
    {
        $dateTimeNow = Carbon::now();
        $request->validate(['pin' => ['required']]);

        $examinee = AssessmentExaminee::with(['assessment', 'examinee', 'group', 'assessment.problems', 'assessment.problems.problemType', 'assessment.problems.problemType.examType'])
            ->where('pin', $request->pin)
            ->where('status', '<>', 'Completed')
            ->where('schedule_from', '<=', $dateTimeNow)
            ->where('schedule_to', '>=', $dateTimeNow)
            ->firstOrFail();


        return new AssessmentExamineeResource($examinee);
    }
}
