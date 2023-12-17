<?php

namespace App\Traits;

trait HttpResponses
{
    protected function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'Request was successful',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error($message, $code, $data = null)
    {
        return response()->json([
            'status' => 'An error occured',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
