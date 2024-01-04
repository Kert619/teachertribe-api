<?php

namespace App\Http\Controllers;

use App\Http\Resources\AssessmentExamineeResource;
use App\Models\AssessmentExaminee;
use Illuminate\Http\Request;

class VerifyPinController extends Controller
{
    //

    public function __invoke(Request $request)
    {
        $request->validate(['pin' => ['required']]);

        $examinee = AssessmentExaminee::with(['assessment', 'examinee', 'group', 'assessment.problems'])->where('pin', $request->pin)->firstOrFail();

        return new AssessmentExamineeResource($examinee);
    }
}
