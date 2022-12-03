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
        Schema::create('student_school_infos', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('student_name');
            $table->string('current_class');
            $table->string('gender');
            $table->string('residential_status')->nullable();
            $table->string('house_affiliation')->nullable();
            $table->string('school_position')->nullable();
            $table->string('club_society')->nullable();
            $table->string('name_of_club')->nullable();
            $table->string('scholarship')->nullable();
            $table->string('scholarship_status')->nullable();
            $table->string('awards_certificates')->nullable();
            $table->string('active')->default('Yes');
            $table->string('exit_date')->nullable();
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
        Schema::dropIfExists('student_school_infos');
    }
};
