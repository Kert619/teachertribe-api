<?php

namespace App\Http\Resources;

use App\Models\AssessmentExaminee;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssessmentResource extends JsonResource
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
            'assessment_title' => $this->assessment_title,
            'description' => $this->description,
            'time_restriction' => $this->time_restriction,
            'setup_time' => $this->setup_time,
            'window_proctor' => $this->window_proctor,
            'randomize' => $this->randomize,
            'assessment_problems' => ProblemResource::collection($this->whenLoaded('problems')),
            'assessment_examinees' => AssessmentExamineeResource::collection($this->whenLoaded('assessmentExaminees')),
        ];
    }
}
