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
        Schema::create('parent_guidance_infos', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('student_name');
            $table->string('name_of_guardian')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('name_of_father')->nullable();
            $table->string('father_mobile_number')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('name_of_mother')->nullable();
            $table->string('mother_mobile_number')->nullable();
            $table->string('mother_occupation')->nullable();
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
        Schema::dropIfExists('parent_guidance_infos');
    }
};
