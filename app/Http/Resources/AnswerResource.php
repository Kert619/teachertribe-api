<?php

namespace App\Http\Resources;

use App\Models\AssessmentExaminee;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'assessmentExaminee' => new AssessmentExamineeResource($this->whenLoaded('assessmentExaminee')),
            'problem' => new ProblemResource($this->whenLoaded('problem')),
            'answer' => $this->answer,
            'score_attained' => $this->score_attained,
            'total_score' => $this->total_score,
        ];
    }
}
