<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('students_to_assessments', function (Blueprint $table) {
            $table->id('id_student_to_assessment');
            $table->foreignId('id_teacher')->references('id_teacher')->on('teachers');
            $table->foreignId('id_student')->references('id_student')->on('students');
            $table->foreignId('id_assessment')->references('id_assessment')->on('assessments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('students_to_assessments');
    }
};
