<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Student extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('StudentID')->unique();
            $table->string('password');
            $table->string('name');
            $table->string('ic');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('address');
            $table->string('faculty');
            $table->string('course');
            $table->string('batch');
            $table->enum('gender', ['male', 'female']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
