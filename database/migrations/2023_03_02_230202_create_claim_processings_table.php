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
        Schema::create('claim_processings', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id')->nullable();
            $table->string('claim_id')->nullable();
            $table->string('claimant_id')->nullable();
            $table->string('primary_diagnosis_icd_leveli_disease')->nullable();
            $table->string('primary_diagnosis_icd_leveli_code')->nullable();
            $table->string('primary_diagnosis_icd_levelii_disease')->nullable();
            $table->string('primary_diagnosis_icd_levelii_code')->nullable();
            $table->string('primary_diagnosis_icd_leveliii_disease')->nullable();
            $table->string('primary_diagnosis_icd_leveliii_code')->nullable();
            $table->string('primary_diagnosis_icd_leveliv_disease')->nullable();
            $table->string('primary_diagnosis_icd_leveliv_code')->nullable();
            $table->string('additional_diagnosis_icd_leveli_disease')->nullable();
            $table->string('additional_diagnosis_icd_leveli_code')->nullable();
            $table->string('additional_diagnosis_icd_levelii_disease')->nullable();
            $table->string('additional_diagnosis_icd_levelii_code')->nullable();
            $table->string('additional_diagnosis_icd_leveliii_disease')->nullable();
            $table->string('additional_diagnosis_icd_leveliii_code')->nullable();
            $table->string('additional_diagnosis_icd_leveliv_disease')->nullable();
            $table->string('additional_diagnosis_icd_leveliv_code')->nullable();
            $table->string('co_morbidities_icd_leveli_disease')->nullable();
            $table->string('co_morbidities_icd_leveli_code')->nullable();
            $table->string('co_morbidities_icd_levelii_disease')->nullable();
            $table->string('co_morbidities_icd_levelii_code')->nullable();
            $table->string('co_morbidities_icd_leveliii_disease')->nullable();
            $table->string('co_morbidities_icd_leveliii_code')->nullable();
            $table->string('co_morbidities_icd_leveliv_disease')->nullable();
            $table->string('co_morbidities_icd_leveliv_code')->nullable();
            $table->text('co_morbidities_comments')->nullable();
            $table->text('procedure_name')->nullable();
            $table->text('procedure_i_pcs_group_name')->nullable();
            $table->text('procedure_i_pcs_group_code')->nullable();
            $table->text('procedure_i_pcs_sub_group_name')->nullable();
            $table->text('procedure_i_pcs_sub_group_code')->nullable();
            $table->text('procedure_i_pcs_short_name')->nullable();
            $table->text('procedure_i_pcs_code')->nullable();
            $table->text('procedure_i_pcs_long_name')->nullable();
            $table->text('procedure_ii_pcs_group_name')->nullable();
            $table->text('procedure_ii_pcs_group_code')->nullable();
            $table->text('procedure_ii_pcs_sub_group_name')->nullable();
            $table->text('procedure_ii_pcs_sub_group_code')->nullable();
            $table->text('procedure_ii_pcs_short_name')->nullable();
            $table->text('procedure_ii_pcs_code')->nullable();
            $table->text('procedure_ii_pcs_long_name')->nullable();
            $table->text('procedure_iii_pcs_group_name')->nullable();
            $table->text('procedure_iii_pcs_group_code')->nullable();
            $table->text('procedure_iii_pcs_sub_group_name')->nullable();
            $table->text('procedure_iii_pcs_sub_group_code')->nullable();
            $table->string('procedure_iii_pcs_short_name')->nullable();
            $table->string('procedure_iii_pcs_code')->nullable();
            $table->string('procedure_iii_pcs_long_name')->nullable();
            $table->enum('final_assessment_status', ['Waiting for Pre-Assessment', 'Query Raised by BHC Team', 'Non Admissible as per the Policy TC', 'Non Admissible as per the Treatment Received', 'Admissible'])->nullable();
            $table->text('processing_query')->nullable();
            $table->double('final_assessment_amount')->nullable();
            $table->text('final_assessment_comments')->nullable();
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
        Schema::dropIfExists('claim_processings');
    }
};
