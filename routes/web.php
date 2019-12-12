<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth'])->group(function () {

    Route::get('show/my-proposer/{identification_code}','UserProfileController@userProfile')->name('show.proposer');

    Route::get('show/my-child/{identification_code}', 'UserProfileController@userProfile')->name('show.child');

    Route::get('/sponsorship','SponsorshipController@viewStart')->name('sponsorship.start');

    Route::get('user/profile', 'UserProfileController@userProfile')->name('user.profile');
});

Route::get('show/my-proposer/{identification_code}','UserProfileController@profile')->name('show.proposer');

Route::get('show/my-child/{identification_code}', 'UserProfileController@profile')->name('show.child');


Route::middleware(['check.user'])->group(function () {
    Route::get('/','HomeController@index')->name('root');
    Route::get('/sponsorship/join','SponsorshipController@joinSponsorshipChannel');
    Route::get('/sponsorship/starting','SponsorshipController@waitingStart');
    Route::get('/sponsorship/reset','SponsorshipController@resetSortTables');
    Route::get('/sponsorship/begin','SponsorshipController@begin');

});

// Chargement des routes d'authentification et Désactivation de la route 'Password Forget'
Auth::routes(['reset' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/sms/code/verification/{code_identification}/{code_verification?}', 'VerificationCodeController@index')->where(['code_identification' => '[a-z0-9]{6}','code_verification'=>'[0-9]{5}'])->name('code.verification');

Route::post('/sms/code/verification/{code_identification}/{code_verification?}', 'VerificationCodeController@codeValidation')->where(['code_identification' => '[a-z0-9]{6}','code_verification'=>'[0-9]{5}'])->name('code.validation');

Route::get('/sms/code/verification/success', 'VerificationCodeController@validationSuccess')->name('code.validation.success');

// Route de tests

Route::get('/testDatabase', 'Test\TestController@testDatabase')->name('testDatabase');

Route::get('/test', 'Test\TestController@test')->name('test');

Route::get('/testCode','Test\TestCodeController@test');

Route::get('/post', 'PostController@index')->name('post');

Route::get('/loginTest', 'Test\TestController@login')->name('test');

Route::get('/successTest', 'Test\TestController@successTest')->name('test4');

Route::get('/startTest', 'Test\TestController@start')->name('test5');
Route::get('/startTest2', 'Test\TestController@start2')->name('test6');

Route::get('/count', 'Test\TestController@countdown')->name('test6');
Route::get('/sponsorship/index','SponsorshipController@index');

Route::get('/sendSMS','SponsorshipController@sendSMS');
