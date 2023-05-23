<?php

namespace App\Helper;

class ResponseHelper
{
    public static function error($data, $status = 200)
    {
        return response()->json([
            'error' => true,
            'data' => $data,
        ], $status);
    }
    
    public static function ok($data, $status = 200)
    {
        return response()->json([
            'error' => false,
            'data' => $data,
        ], $status);
    }
}
