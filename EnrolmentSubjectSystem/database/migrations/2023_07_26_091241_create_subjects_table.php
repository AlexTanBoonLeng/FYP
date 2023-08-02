<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subject_id');
            $table->string('name');
            $table->Integer('credit');
            $table->string('day_and_time'); 
            $table->string('classroom');
            $table->unsignedBigInteger('lecturer_id')->nullable();
            $table->timestamps();
    
            // Foreign key constraint
            $table->foreign('lecturer_id')->references('id')->on('lecturers')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
