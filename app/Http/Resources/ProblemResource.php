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
            'problemTitle' => $this->problem_title,
            'problemDescription' => $this->problem_description,
            'problemType' => new ProblemTypeResource($this->whenLoaded('problemType')),
            'difficulty' => $this->difficulty,
            'duration' => $this->duration,
            'instructions' => $this->instructions
        ];
    }
}
