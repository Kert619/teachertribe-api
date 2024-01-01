<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examinee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function assessmentExaminee(){
        return $this->hasOne(AssessmentExaminee::class);
    }
}
