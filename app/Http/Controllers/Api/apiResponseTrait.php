<?php

namespace App\Http\Controllers\Api;

trait apiResponseTrait
{
    public function apiResponse($data = null,$msg=null,$staus=null)
    {
        $format = [
            'data' => $data,
            'msg' => $msg,
            'status' => $staus
        ];
        return response($format);
    }
}
