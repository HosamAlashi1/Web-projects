<?php

namespace App\Http\Controllers\Api;

trait responseTrait
{
    public function apiResponse($data = null , $message = null , $status)
    {
        $array = [
            'data'=>$data,
            'message'=>$message,
            'status'=>$status
        ];
        return response($array,200);
    }
}
