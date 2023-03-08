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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignId('university_id')->constrained();
            $table->foreignId('faculty_id')->constrained();
            $table->foreignId('specialty_id')->constrained();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('user_id')->constrained();
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
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['university_id'], ['faculty_id'], ['specialty_id'], ['course_id'], ['user_id']);
        });
        Schema::dropIfExists('students');
    }
};
