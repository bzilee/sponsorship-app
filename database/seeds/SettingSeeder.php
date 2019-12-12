<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Setting::class, 1)->create()/*->each(function ($user) {
           // $user->contacts()->save(factory(Contacts::class)->make());
        })*/;
    }
}
