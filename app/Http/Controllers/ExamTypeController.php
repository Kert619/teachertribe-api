<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExamTypeResource;
use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $examTypes = ExamType::with(['problemTypes', 'problemTypes.problems'])->get();
        return ExamTypeResource::collection($examTypes);
    }

    /**
     * Display the specified resource.
     */
    public function show(ExamType $examType)
    {
        $examType->load(['problemTypes', 'problemTypes.problems']);
        return new ExamTypeResource($examType);
    }
}
