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
        Schema::create('hospital_documents', function (Blueprint $table) {
            $table->id();
            $table->string('hospital_id')->nullable();
            $table->string('hospital_pan_card')->nullable();
            $table->string('hospital_cancel_cheque')->nullable();
            $table->string('hospital_owners_pan_card')->nullable();
            $table->string('hospital_owners_aadhar_card')->nullable();
            $table->string('hospital_other_documents')->nullable();
            $table->string('pharmacy')->nullable();
            $table->string('lab')->nullable();
            $table->string('ambulance')->nullable();
            $table->string('operation_theatre')->nullable();
            $table->string('icu')->nullable();
            $table->string('iccu')->nullable();
            $table->string('nicu')->nullable();
            $table->string('csc_sterilization')->nullable();
            $table->string('centralized_gas_ons')->nullable();
            $table->string('centralized_ac')->nullable();
            $table->string('kitchen')->nullable();
            $table->string('usg_machine')->nullable();
            $table->string('digital_x_ray')->nullable();
            $table->string('ct')->nullable();
            $table->string('mri')->nullable();
            $table->string('pet_scan')->nullable();
            $table->string('organ_transplant_unit')->nullable();
            $table->string('burn_unit')->nullable();
            $table->string('dialysis_unit')->nullable();
            $table->string('blood_bank')->nullable();
            $table->string('other')->nullable();
            $table->string('hospital_registration_certificate')->nullable();
            $table->string('hospital_rohini_certificate')->nullable();
            $table->string('hospital_pollution_clearance_certificate')->nullable();
            $table->string('hospital_fire_safety_clearance_certificate')->nullable();
            $table->string('hospital_certificate_of_incorporation')->nullable();
            $table->string('hospital_tan_certificate')->nullable();
            $table->string('hospital_gst_certificate')->nullable();
            $table->string('nabl_certificate')->nullable();
            $table->string('nabh_certificate')->nullable();
            $table->string('jci_certificate')->nullable();
            $table->string('nqac_or_nhsrc_certificate')->nullable();
            $table->string('hippa_certificate')->nullable();
            $table->string('iso_certificates')->nullable();
            $table->string('other_certificates')->nullable();
            $table->string('medical_superintendents_registration_certificate')->nullable();
            $table->string('doctors_registration_certificate_other')->nullable();
            $table->string('mou_with_bhc')->nullable();
            $table->string('mous_with_nbfcs_banks_triparty')->nullable();
            $table->string('mous_ic_or_tpa_or_govt_or_psu_or_other_corporates')->nullable();
            $table->string('agreed_tariff_and_packages')->nullable();
            $table->string('other_packages')->nullable();
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
        Schema::dropIfExists('hospital_documents');
    }
};
