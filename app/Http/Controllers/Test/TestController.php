<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testDatabase()
    {

        // Make call to application...
        echo  $this->assertDatabaseHas('users', [
            'email' => 'sally@example.com',
        ]);
    }

    public function test()
    {
        $data  = [];
        $data[] = "fgffgfg";
        $data[] = "fgffgfg";
       var_dump( $data);
    }

    public function test1()
    {
        $data  = [ 'e'=>'je', 'e'=>'tu', 'e'=>'il'];

       var_dump( array_fill_keys($data, 'users_id'));
    }

    public function login()
    {
        return view('register');
    }

    public function successTest()
    {
        return view('successRegister', [
            'css_page' => 'app.succes.register.css',
            'last_name_user' => 'Bzile',
            'count_down_date' => '2020-05-22 00:00:00'
        ]);
    }

    public function start()
    {
        return view('sponsorship.sponsorshipStart', [
            'css_page' => 'app.sponsorship.css',
            'count_down_date' => '2020-05-22 00:00:00'
        ]);
    }


    public function start2()
    {
        return view('sponsorship.sponsorshipStart2', [
            'css_page' => 'app.sponsorship.css',
            'less_css_page' => 'main.css',
            'js_page' => 'sponsorship.js',
            'count_down_date' => '2020-05-22 00:00:00'
        ]);
    }


    public function countdown()
    {
        return view('sponsorship.sponsorshipStartCount', [
            'css_page' => 'app.sponsorship.css',
            'count_down_date' => '2019-11-29 18:49:00',
            'count_down_nav' => false,
            'js_page' => 'simpleCountdountInstance.js',
            'js_page2' => 'sponsorship.js'
        ]);
    }

    public function gutemb()
    {

        return view('test.gutemb', [
            'css_page' => 'app.sponsorship.css',
            'count_down_date' => '2019-11-29 18:49:00',
            'count_down_nav' => false,

            'js_page2' => 'gutemb.js'
        ]);
    }


}
