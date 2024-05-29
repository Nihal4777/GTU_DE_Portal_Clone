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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->text('remarks')->nullable();
            $table->text('filename');
            $table->bigInteger('document_id')->unsigned();
            $table->bigInteger('submitted_by')->unsigned();
            $table->integer("status");
            $table->bigInteger('team_id')->unsigned();
            $table->foreign('document_id')->references('id')->on('document_types');
            $table->foreign('submitted_by')->references('id')->on('users');
            $table->foreign('status')->references('id')->on('request_status');
            $table->foreign('team_id')->references('id')->on('teams');
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
        Schema::dropIfExists('documents');
    }
};
