<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('max_affiliation')->nullable();
            $table->integer('iteration_order')->nullable(); // Represente le nombre total de la boucle principale
            $table->integer('iteration_level')->nullable(); // Represente le nombre total de la boucle secondaire
            $table->integer('iteration_order_stop')->nullable(); // Represente l'ordre d'arret de la boucle principale
            $table->integer('iteration_level_stop')->nullable(); // Represente la position d'arret de la boucle secondaire
            $table->integer('iteration_remainber')->nullable(); // Represente la
            $table->integer('remainber')->nullable(); // Represente le nombre d'iteration de la derniere boucle à faire
            $table->boolean('stop_process')->default(false);
            $table->dateTime('sponsorship_date')->default('2019-11-29 10:3:00');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
