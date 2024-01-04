<?php

namespace App\Http\Middleware;

use App\Models\AssessmentExaminee;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePinIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $examinee = AssessmentExaminee::where('pin', $request->pin)->first();
        if(!$examinee) return response()->json(['message' => 'Invalid test pin'], 403);

        return $next($request);
    }
}
