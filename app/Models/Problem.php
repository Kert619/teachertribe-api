<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function problemType(){
        return $this->belongsTo(ProblemType::class);
    }

    public function assessments(){
        return $this->belongsToMany(Assessment::class, 'assessments_problems')->as('problem_assessments');
    }
}
