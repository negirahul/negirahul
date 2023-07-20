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

        Schema::create('claims', function (Blueprint $table) {
           $table->id();
           $table->string('uid')->nullable();
           $table->integer('patient_id')->nullable();
           $table->integer('hospital_id')->nullable();
           $table->string('admission_date')->nullable();
           $table->time('admission_time')->nullable();
           $table->string('abha_id')->nullable();
           $table->enum('insurance_coverage', ['Yes', 'No'])->default('No');
           $table->string('policy_no')->nullable();
           $table->string('company_tpa_id_card_no')->nullable();
           $table->enum('lending_required', ['Yes', 'No'])->default('No');
           $table->string('hospitalization_due_to')->nullable();
           $table->string('date_of_delivery')->nullable();
           $table->string('system_of_medicine')->nullable();
           $table->enum('treatment_type', ['OPD', 'IPD'])->default('OPD');
           $table->string('admission_type_1')->nullable();
           $table->string('admission_type_2')->nullable();
           $table->string('admission_type_3')->nullable();
           $table->string('claim_category')->nullable();
           $table->enum('treatment_category', ['Surgical', 'Medical Management', 'Intensive Care', 'Investigation', 'Non Allopathic'])->nullable();
           $table->string('disease_category')->nullable();
           $table->string('disease_name')->nullable();
           $table->string('disease_type')->nullable();
           $table->string('estimated_amount')->nullable();
           $table->text('comments')->nullable();
           $table->string('claim_intimation_done')->nullable();
           $table->string('claim_intimation_number_mail')->nullable();
           $table->string('discharge_date')->nullable();
           $table->string('days_in_hospital')->nullable();
           $table->string('room_category')->nullable();
           $table->string('consultation_date')->nullable();
           $table->string('nature_of_illness')->nullable();
           $table->string('clinical_finding')->nullable();
           $table->text('chronic_illness')->nullable();
           $table->text('ailment_details')->nullable();
           $table->string('has_family_physician')->nullable();
           $table->string('family_physician')->nullable();
           $table->string('family_physician_contact_no')->nullable();
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
        Schema::dropIfExists('claims');
    }
};
