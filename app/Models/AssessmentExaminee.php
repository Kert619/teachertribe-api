<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentExaminee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function assessment(){
        return $this->belongsTo(Assessment::class);
    }

    public function examinee(){
        return $this->belongsTo(Examinee::class);
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function problems(){
        return $this->belongsToMany(Problem::class, 'assessment_examinees_problems')->as('problems');
    }
}
