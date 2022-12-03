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
        Schema::create('new_admissions', function (Blueprint $table) {
            $table->id();
            $table->string('admission_number');
            $table->string('sur_name');
            $table->string('other_names');
            $table->string('gender')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('class');
            $table->decimal('admission_fees', 10)->default(0.00);
            $table->string('fees_in_words');
            $table->string('date_of_reporting');
            $table->string('admitted')->default('No');
            $table->string('date_of_admission')->nullable();
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
        Schema::dropIfExists('new_admissions');
    }
};
