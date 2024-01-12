<?php

namespace App\Http\Controllers;

use App\Models\AssessmentExaminee;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class IncrementRetryCountController extends Controller
{
    use HttpResponses;
    public function __invoke(AssessmentExaminee $assessmentExaminee)
    {
        $assessmentExaminee->retry_count++;
        $assessmentExaminee->save();
        return $this->success($assessmentExaminee);
    }
}
