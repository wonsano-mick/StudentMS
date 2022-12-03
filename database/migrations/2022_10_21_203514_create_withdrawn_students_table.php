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
        Schema::create('withdrawn_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_id');
            $table->string('admission_number')->nullable();
            $table->string('sur_name');
            $table->string('other_names');
            $table->string('gender', 6);
            $table->string('date_of_birth');
            $table->string('date_of_admission');
            $table->string('class_before')->nullable();
            $table->string('current_class');
            $table->string('date_of_exit');
            $table->string('residential_address')->nullable();
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
        Schema::dropIfExists('withdrawn_students');
    }
};
