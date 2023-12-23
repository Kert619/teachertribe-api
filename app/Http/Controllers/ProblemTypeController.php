<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProblemTypeResource;
use App\Models\ExamType;
use App\Models\ProblemType;
use Illuminate\Http\Request;

class ProblemTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $problemTypes = ProblemType::with('examType')->get();
        return ProblemTypeResource::collection($problemTypes);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProblemType $problemType)
    {
        $problemType->load('examType');
        return new ProblemTypeResource($problemType);
    }

    public function getAllByExamTypeId(ExamType $examType){
        $problemTypes = ProblemType::with('examType')->whereBelongsTo($examType)->get();
        return ProblemTypeResource::collection($problemTypes);
    }
}
