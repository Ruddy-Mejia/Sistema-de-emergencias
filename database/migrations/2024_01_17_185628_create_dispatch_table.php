<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatch', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('ambulance_id');
            $table->foreign('ambulance_id')->references('id')->on('ambulance');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('code_autizacion');

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
        Schema::dropIfExists('dispatch');
    }
};
