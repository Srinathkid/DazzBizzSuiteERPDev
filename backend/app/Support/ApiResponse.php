<?php
namespace App\Support;

class ApiResponse
{
    public static function success(
        string $message ='Success',
        mixed $data=null,
        int $status=200
    ){
        return response()->json([
            'success'=>true,
            'message'=>$message,
            'data'=>$data,
        ],$status);
    }

    public static function error(
        string $message,
        mixed $data = null,
        int $status = 400
    ) {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}