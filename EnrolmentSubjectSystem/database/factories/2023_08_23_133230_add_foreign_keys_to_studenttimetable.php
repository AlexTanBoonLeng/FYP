<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStudentTimetable extends Migration
{
    public function up()
    {
        Schema::table('studenttimetable', function (Blueprint $table) {
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('studenttimetable', function (Blueprint $table) {
            $table->dropForeign(['subject_id']);
            $table->dropForeign(['batch_id']);
        });
    }
}
