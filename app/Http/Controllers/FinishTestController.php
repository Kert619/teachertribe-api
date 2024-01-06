<?php

namespace App\Http\Controllers;

use App\Http\Resources\AssessmentExamineeResource;
use App\Models\Answer;
use App\Models\AssessmentExaminee;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinishTestController extends Controller
{
  use HttpResponses;
  public function __invoke(AssessmentExaminee $assessmentExaminee)
  {
    $answers =  Answer::where('assessment_examinee_id', $assessmentExaminee->id)->get();

    $scoreAttained = $answers->sum('score_attained');
    $totalScore = $answers->sum('total_score');
    $marks = "$scoreAttained/$totalScore";

    $assessmentExaminee->update([
      'finished_on' => Carbon::now(),
      'marks' => $marks,
      'status' => 'Completed'
    ]);

    $assessmentExaminee->load(['assessment', 'examinee', 'group']);

    $ids = $assessmentExaminee->assessment->problems->pluck('id');

    $assessmentExaminee->problems()->attach($ids);

    return $this->success(new AssessmentExamineeResource($assessmentExaminee));
  }
}
