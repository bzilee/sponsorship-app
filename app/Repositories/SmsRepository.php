<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */


namespace App\Repositories;

use App\Models\Sms;
use App\User;

class SmsRepository
{
    /**
     * @var Sms
     */
    private $model;

    /**
     * SmsRepository constructor.
     * @param Sms $model
     */
    public function __construct()
    {

    }

    /**
     * Return a new instance of Sms Model
     *
     * @return Sms
     */
    public function newInstance()
    {
        return $this->model->newInstance();
    }


    /**
     * Return a new instance of Sms Model
     *
     * @return Sms
     */
    public function create($identification_code, $data)
    {
        User::where('identification_code',$identification_code)->first()->sms()->create([
            'phone_number' => $data['phone_number'],
            'msg' => $data['msg'],
            'status_code' => $data['status_code'],
            'body_response' => $data['body_response'],
        ]);

    }
}
