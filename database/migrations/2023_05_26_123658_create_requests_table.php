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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->bigInteger('submitted_by')->unsigned();
            $table->integer('status');
            $table->string('remarks')->nullable();
            $table->foreign('type')->references('id')->on('request_types');
            $table->foreign('submitted_by')->references('id')->on('users');
            $table->foreign('status')->references('id')->on('request_status');
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
        Schema::dropIfExists('requests');
    }
};
