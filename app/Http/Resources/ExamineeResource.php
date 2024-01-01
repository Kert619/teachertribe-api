<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamineeResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'contact' => $this->contact,
            'last_school_attended' => $this->last_school_attended,
            'degree' => $this->degree,
            'field_of_study' => $this->field_of_study,
            'programming_experience' => $this->programming_experience,
        ];
    }
}
