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
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('nature');
            $table->string('latitude');
            $table->string('longitude');
            $table->text('description');
            $table->string('type');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patient');
            $table->string('evidence');
            $table->text('details')->nullable();
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
        Schema::dropIfExists('incidents');
    }
};
