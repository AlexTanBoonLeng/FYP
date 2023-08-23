<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubjectIdToStudentTimetable extends Migration
{
    public function up()
    {
        Schema::table('studenttimetable', function (Blueprint $table) {
            $table->unsignedBigInteger('subject_id');
        });
    }

    public function down()
    {
        Schema::table('studenttimetable', function (Blueprint $table) {
            $table->dropColumn('subject_id');
        });
    }
}

