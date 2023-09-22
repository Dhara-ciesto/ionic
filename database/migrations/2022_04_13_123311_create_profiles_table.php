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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->text('university')->nullable();
            $table->text('education')->nullable();
            $table->text('other_qualification')->nullable();
            $table->text('roles')->nullable();
            $table->string('cv')->nullable();


            // $table->string('degree')->nullable();
            // $table->string('grades_achieved')->nullable();
            // $table->string('education_institutional')->nullable();
            // $table->string('education_level')->nullable();
            // $table->string('grades_achieved2')->nullable();
            // $table->string('other_qualification')->nullable();
            // $table->string('city')->nullable();
            // $table->string('industry')->nullable();
            // $table->string('job_type')->nullable();
            // $table->string('cv')->nullable();
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
        Schema::dropIfExists('profiles');
    }
};
