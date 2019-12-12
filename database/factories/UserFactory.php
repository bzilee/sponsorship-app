<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Helpers\VerificationCodeHelper;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $index_type = rand ( 0 ,  2 ) ;
    $index_sexe = rand ( 0 ,  1 ) ;
    $index_filiere = rand ( 0 ,  3 ) ;
    $type = ['Admin', 'Parent','Child'];
    $sexe = ['Masculin', 'Feminin'];
    $filiere = ['SR1', 'SR2','GL1', 'GL2'];
    $which_filiere = $filiere[$index_filiere];
    $which_type = (($which_filiere == $filiere[0] || $which_filiere == $filiere[2])? $type[2]:$type[1]);
    $identification_code = VerificationCodeHelper::getIdentificationCode(15);

    return [
        'name' => $faker->name,
        'last_name' => $faker->lastName,
        'nb_filleules'=> ($which_filiere == 'GL2' || $which_filiere == 'SR2')?0: null,
        'sexe' => $sexe[$index_sexe],
        'filiere' => $which_filiere,
        'type' => $which_type,
        'photo' =>  $faker->words(20, true),
        'email' => $faker->unique()->safeEmail,
        'identification_code' => $identification_code,
        //'url_link_affiliate' => "/show\/".(($which_type == "Parent")?'my-child':'my-proposer/').$identification_code,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
