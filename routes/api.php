<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/sms/verification', function (Request $request) { ///{number}/{text}

    $cmd = 'gammu-smsd-inject -c smsdrc TEXT '.$request->number.' -text  "'.$request->text.'"';

    //$cmd = 'gammu-smsd-inject -c smsdrc TEXT 655149221 -text  "Si tu recois ce msg repond moi Jojo par ce meme num #Tankeu"';

    //$cmd2 = 'gammu --sendsms TEXT 694074510 -text "Désolé numero utilisé à des fins de text de messagerie par programmation(Gammu)';
    echo shell_exec($cmd);

});
