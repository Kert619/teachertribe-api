<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssessmentExamineeResource extends JsonResource
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
            'assessment' => new AssessmentResource($this->whenLoaded('assessment')),
            'examinee' => new ExamineeResource($this->whenLoaded('examinee')),
            'pin' => $this->pin,
            'test_mode' => $this->test_mode,
            'group' => new GroupResource($this->whenLoaded('group')),
            'schedule_from' => $this->schedule_from,
            'schedule_to' => $this->schedule_to,
            'started_on' => $this->started_on,
            'finished_on' => $this->finished_on,
            'marks' => $this->marks,
            'status' => $this->status,
            'retry_count' => $this->retry_count,
            'answers' => AnswerResource::collection($this->whenLoaded('answers')),
            'problems' => ProblemResource::collection($this->whenLoaded('problems'))
        ];
    }
}
