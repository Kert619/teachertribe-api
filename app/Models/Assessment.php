<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function problems(){
        return $this->belongsToMany(Problem::class, 'assessments_problems')->as('assessment_problems');
    }
}
