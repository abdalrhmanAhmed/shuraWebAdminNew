<?php

namespace App\Http\Services;

use App\Models\User_verfication;

class verficationServices
{
    public function setVerficationCode($data)
    {
        $code = mt_rand(1000, 9999);
        $data['verfication_code'] = $code;
        User_verfication::whereNotNull('user_id')->where(['user_id' => $data['user_id']])->delete();
        return User_verfication::create($data);
    }
}