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
        Schema::create('assessment_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id')->nullable();
            $table->string('claim_id')->nullable();
            $table->string('claimant_id')->nullable();
            $table->string('hospital_id')->nullable();           
            $table->string('hospital_on_the_panel_of_insurance_co')->nullable();
            $table->string('hospital_id_insurance_co')->nullable();
            $table->enum('pre_assessment_status', ['Waiting for Pre-Assessment', 'Query Raised by BHC Team', 'Non Admissible as per the Policy TC', 'Non Admissible as per the Treatment Received', 'Admissible'])->nullable();
            $table->string('query_pre_assessment')->nullable();
            $table->string('pre_assessment_amount')->nullable();
            $table->enum('pre_assessment_suspected_fraud', ['Yes', 'No'])->nullable();
            $table->string('pre_assessment_status_comments')->nullable();
            $table->enum('final_assessment_status', ['Waiting for Pre-Assessment', 'Query Raised by BHC Team', 'Non Admissible as per the Policy TC', 'Non Admissible as per the Treatment Received', 'Admissible'])->nullable();
            $table->string('query_final_assessment')->nullable();
            $table->string('final_assessment_amount')->nullable();
            $table->enum('final_assessment_suspected_fraud', ['Yes', 'No'])->nullable();
            $table->string('final_assessment_status_comments')->nullable();
            $table->tinyInteger('status')->unsigned()->default(1)->nullable();
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
        Schema::dropIfExists('assessment_statuses');
    }
};
