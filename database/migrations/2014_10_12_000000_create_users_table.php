<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('rol_id')->default(1);
            $table->string('last_name');
            $table->string('motherlast_name');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('address');
            $table->string('city');
            $table->string('type');
            $table->integer('phone');
            $table->string('status');
            $table->string('photo', 255);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('avatar');
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('rol_id')->references('id')->on('roles')->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
