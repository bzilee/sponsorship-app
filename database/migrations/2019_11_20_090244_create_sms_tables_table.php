<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('phone_number');
            $table->text('msg');
            $table->integer('status_code');
            $table->text('body_response');
            $table->unsignedBigInteger('users_id');

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
        Schema::dropIfExists('sms_tables');
    }
}
