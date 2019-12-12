<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Http\Controllers\Test;

use App\Helpers\VerificationCodeHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\VerificationCodeController;
use Illuminate\Http\Request;

class TestCodeController extends Controller
{
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function test()
    {
        echo VerificationCodeHelper::getCode(5);
    }
}
