<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTimetableTable extends Migration
{
    public function up()
    {
        Schema::create('studenttimetable', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('batch_id');
            
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
            
      
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('studenttimetable');
    }
}





