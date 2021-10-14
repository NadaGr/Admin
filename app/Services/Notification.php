<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\User;

class Notification 
{
    public function sendNotification($id_user,$type,$title,$body,$service)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
            $FcmToken = User::where('id',$id_user)->pluck('token')->all();
            $serverKey = 'AAAA0beoZdo:APA91bFflmeYdpJtIiQz1U-1qsIgtfkQ0Wo8fsHAecUwKVbrmkmpZmqNdgrLycY-ogjJ2sY7gQjeHZBkLuKNofF-zdr4SZlDWLHlMQ16wBtsae5SpkI6tmFI2Rt3OvHq-obfupk9SKmm';
            $data = [
                "registration_ids" => $FcmToken,
                "notification" => [
                    "type"=> $type,
                    "title" => $title,
                    "body" => $body,
                ],
                "data"=> [
                    $service
                ]

            ];
            $encodedData = json_encode($data);
            $headers = [
                'Authorization:key=' . $serverKey,
                'Content-Type: application/json',
            ];
    
            $ch = curl_init();
    
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }
            curl_close($ch);
        
    }
      
}
