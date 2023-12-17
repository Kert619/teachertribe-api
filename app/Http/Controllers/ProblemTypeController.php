<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProblemTypeResource;
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
}
