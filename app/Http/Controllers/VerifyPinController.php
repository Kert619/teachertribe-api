<?php

namespace App\Http\Controllers;

use App\Http\Resources\AssessmentExamineeResource;
use App\Models\AssessmentExaminee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerifyPinController extends Controller
{
    //

    public function fetchPin(Request $request)
    {
        $dateTimeNow = Carbon::now();
        $request->validate(['pin' => ['required']]);

        $assessmentExaminee = AssessmentExaminee::with(['assessment', 'examinee', 'group', 'assessment.problems' => function ($query) {
            $query->orderBy('order');
        }, 'assessment.problems.problemType', 'assessment.problems.problemType.examType'])
            ->where('pin', $request->pin)
            ->where('status', '<>', 'Completed')
            ->where('schedule_from', '<=', $dateTimeNow)
            ->where('schedule_to', '>=', $dateTimeNow)
            ->firstOrFail();

        return new AssessmentExamineeResource($assessmentExaminee);
    }

    public function verifyPin(Request $request)
    {
        $dateTimeNow = Carbon::now();
        $request->validate(['pin' => ['required']]);

        $assessmentExaminee = AssessmentExaminee::with(['assessment', 'examinee', 'group', 'assessment.problems' => function ($query) {
            $query->orderBy('order');
        }, 'assessment.problems.problemType', 'assessment.problems.problemType.examType'])
            ->where('pin', $request->pin)
            ->where('status', '<>', 'Completed')
            ->where('schedule_from', '<=', $dateTimeNow)
            ->where('schedule_to', '>=', $dateTimeNow)
            ->firstOrFail();

        if ($assessmentExaminee->started_on) {
            $assessmentExaminee->update([
                'retry_count' => $assessmentExaminee->retry_count + 1
            ]);
        }

        return new AssessmentExamineeResource($assessmentExaminee);
    }
}
