<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function examType()
    {
        return $this->belongsTo(ExamType::class);
    }

    public function problems(){
        return $this->hasMany(Problem::class);
    }
}
