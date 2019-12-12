<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Helpers;

use guzzlehttp\guzzle\Client;
use guzzlehttp\Psr7\Request;
use App\Models\SmsTable;
use App\Repositories\SmsRepository;

class SendSMSHelper
{
    /**
     *
     *
     * Undocumented function long description
     *
     * @param Client $var Description
     * @return type
     * @throws conditon
     **/
    public static function sendCodeVerification($code_identification, $number, $text)
    {
        $client = new \GuzzleHttp\Client();
        $repository_sms = new SmsRepository();

        $response = $client->request(
            'POST',
            config('data.url').'/api/sms/verification',
            [
                'form_params' => [
                    'number' => $number,
                    'text' => $text
                ]
            ]
        );

        // Archivage du sms de reception d'un code de verification
        $repository_sms->create(
            $code_identification,
            [
                'phone_number' =>$number,
                'msg' => $text,
                'status_code' => $response->getStatusCode(),
                'body_response' => $response->getBody(),

            ]
        );

    }

    /**
     *
     *
     * Undocumented function long description
     *
     * @param Client $var Description
     * @return type
     * @throws conditon
     **/
    public static function sendSMS($code_identification, $number, $text)
    {
        $client = new \GuzzleHttp\Client();
        $repository_sms = new SmsRepository();

        $response = $client->request(
            'POST',
            config('data.url').'/api/sms/verification',
            [
                'form_params' => [
                    'number' => $number,
                    'text' => $text
                ]
            ]
        );

        // Archivage du sms de reception d'un code de verification
        $repository_sms->create(
            $code_identification,
            [
                'phone_number' =>$number,
                'msg' => $text,
                'status_code' => $response->getStatusCode(),
                'body_response' => $response->getBody(),

            ]
        );

    }


}
