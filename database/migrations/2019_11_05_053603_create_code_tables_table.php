<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodeTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('code_verification');
            $table->unsignedBigInteger('users_id');
            $table->dateTime('expire_at');
            $table->boolean('verified')->default(0);
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('code_tables');
    }
}
