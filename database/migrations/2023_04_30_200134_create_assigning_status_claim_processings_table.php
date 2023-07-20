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
        Schema::create('assigning_status_claim_processings', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id')->nullable();
            $table->string('patient_name')->nullable();
            $table->string('claim_id')->nullable();
            $table->string('hospital_id')->nullable();
            $table->string('hospital_name')->nullable();
            $table->string('hospital_address')->nullable();
            $table->string('associate_partner_name')->nullable();
            $table->string('pre_assessment_status')->nullable();
            $table->string('discharge_status_saved_date_time')->nullable();
            $table->string('discharge_status')->nullable();
            $table->string('assigning_pending_tat')->nullable();
            $table->string('assign_to')->nullable();
            $table->string('final_assessment_status')->nullable();
            $table->string('final_assessment_pending_tat')->nullable();
            $table->string('re_assign_to')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('assigning_status_claim_processings');
    }
};
