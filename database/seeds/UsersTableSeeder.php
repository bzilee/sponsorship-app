<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 150)->create()/*->each(function ($user) {
           // $user->contacts()->save(factory(Contacts::class)->make());
        })*/;
    }
}
