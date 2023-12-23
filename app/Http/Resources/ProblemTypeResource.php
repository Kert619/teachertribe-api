<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProblemTypeResource extends JsonResource
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
            'problem_type' => $this->problem_type,
            'exam_type' => new ExamTypeResource($this->whenLoaded('examType')),
            'problems' => ProblemResource::collection($this->whenLoaded('problems'))
        ];
    }
}
