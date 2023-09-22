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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('client_id')->nullable();
            $table->string('role')->nullable();
            $table->string('full_name')->nullable();
            $table->string('current_location')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('visa_status')->nullable();
            $table->string('w2_rate')->nullable();
            $table->string('c2c_rate')->nullable();
            $table->string('c2c_employer_name')->nullable();
            $table->string('c2c_employer_email')->nullable();
            $table->string('c2c_employer_contact')->nullable();
            $table->string('client_name')->nullable();
            $table->string('end_client_name')->nullable();
            $table->string('submission_to_client_rate')->nullable();
            $table->string('client_manager_name')->nullable();
            $table->string('acestack_manager_name')->nullable();
            $table->string('recruiter_name')->nullable();
            $table->string('update_by_acestack_manager')->nullable();
            $table->text('resume_or_other_documents')->nullable();
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
        Schema::dropIfExists('submissions');
    }
};
