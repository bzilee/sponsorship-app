<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Helpers;

class VerificationCodeHelper
{

    public static function getVerificationCode($lengh){
        $alphabet = "123456789";
        return substr(str_shuffle(str_repeat($alphabet, $lengh)), 0, $lengh) ;
    }

     public static function getIdentificationCode($lengh){
        $alphabet = "123456789abceimnrstuvwxz";
        return substr(str_shuffle(str_repeat($alphabet, $lengh)), 0, $lengh) ;
    }
}
