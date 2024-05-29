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
        Schema::create('users', function (Blueprint $table) {
            $table->id();       
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile',15);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // $table->rememberToken();
            $table->string('gender',1);
            $table->integer('college_id');
            $table->integer('department_id');
            $table->integer('discipline_id');
            $table->foreign('college_id')->references('id')->on('colleges');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('discipline_id')->references('id')->on('disciplines');
            $table->smallInteger("semester");
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
};
