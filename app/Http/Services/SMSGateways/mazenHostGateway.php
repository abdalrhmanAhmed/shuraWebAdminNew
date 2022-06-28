<?php

namespace App\Http\Services\SMSGateways;

class mazenHostGateway
{
    public function sendSMS($data, $code)
    {
        $curl = curl_init();
        $from = "shura";
        $to = $data->phone;
        $message = "رمز التحقق من حسابك هو  " . $code . ' الرجاء عدم مشاركته مع أحد !';
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://mazinhost.com/smsv1/sms/api",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "action=send-sms&api_key=c2h1cmEuYXBwLnNkQGdtYWlsLmNvbTpwaENCcyY5VW10&to=249$to&from=$from&sms=$message&unicode=1",
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        // echo $response;
    }

}