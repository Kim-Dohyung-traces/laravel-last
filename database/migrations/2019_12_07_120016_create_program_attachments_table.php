<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('program_id')->index();
            $table->string('filename');
            $table->unsignedBigInteger('bytes');
            $table->string('mime');
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('programs')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_attachments');
    }
}
