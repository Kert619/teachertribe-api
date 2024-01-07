<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProblemResource extends JsonResource
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
            'problem_title' => $this->problem_title,
            'description' => $this->description,
            'problem_type' => new ProblemTypeResource($this->whenLoaded('problemType')),
            'difficulty' => $this->difficulty,
            'duration' => $this->duration,
            'instructions' => $this->instructions,
            'score' => $this->score,
            'problem_assessments' => AssessmentResource::collection($this->whenLoaded('assessments')),
            'date_created' => $this->created_at,
            'answers' => AnswerResource::collection($this->whenLoaded('answers'))
        ];
    }
}
