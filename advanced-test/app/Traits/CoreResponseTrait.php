<?php

namespace App\Traits;

trait CoreResponseTrait
{


    public function successResponse($result = [], $code = 200)
    {
        return response()->json(['status' => 'success', 'result' => $result], $code);
    }

    public function errorResponse($message = '', $code = 400)
    {
        return response()->json(['status' => 'error', 'message' => $message, 'result' => null], $code);
    }
}
