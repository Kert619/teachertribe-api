<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class AssessmentExaminee extends Model
{
    use HasApiTokens;
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
}
