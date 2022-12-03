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
            $table->string('id', 10)->nullable();
            $table->bigIncrements('SN');
            $table->bigInteger('sid');
            $table->string('sch_id');
            $table->string('student_id')->unique();
            $table->string('admission_number')->nullable();
            $table->string('sur_name');
            $table->string('other_names');
            $table->string('gender', 6);
            $table->string('date_of_birth');
            $table->string('date_of_admission');
            $table->string('current_class');
            $table->integer('current_class_id')->nullable();
            $table->string('sub_current_class')->nullable();
            $table->string('actual_class')->nullable();
            $table->string('term');
            $table->string('academic_year');
            $table->string('residential_address')->nullable();
            $table->string('check_student');
            $table->string('religion')->nullable();
            $table->string('denomination')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('student_image')->nullable();
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
        Schema::dropIfExists('students');
    }
};
