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
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->nullable();
            $table->string('name');
            $table->text('avatar')->nullable();
            $table->enum('onboarding', ['Tie Up', 'Non - Tie Up'])->default('Tie Up');
            $table->enum('by', ['Direct', 'Associate Partner'])->default('Direct');
            $table->enum('hospital_by', ['Claimstack', 'Hms'])->default('Claimstack');
            $table->integer('hms_hospital_id')->nullable();
            $table->longText('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('pan')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('code')->nullable();
            $table->string('landline')->nullable();
            $table->string('phone')->nullable();
            $table->string('rohini')->nullable();
            $table->string('linked_employee_department')->nullable();
            $table->string('linked_associate_partner')->nullable();
            $table->string('linked_associate_partner_id')->nullable();
            $table->string('assigned_employee_department')->nullable();
            $table->string('assigned_employee')->nullable();
            $table->string('assigned_employee_id')->nullable();
            $table->string('linked_employee')->nullable();
            $table->string('linked_employee_id')->nullable();
            $table->string('tan')->nullable();
            $table->string('gst')->nullable();
            $table->string('owner_email')->nullable();
            $table->string('owner_phone')->nullable();
            $table->text('owner_pan')->nullable();
            $table->string('owner_aadhar')->nullable();
            $table->string('contact_person_firstname')->nullable();
            $table->string('contact_person_lastname')->nullable();
            $table->string('contact_person_email')->nullable();
            $table->string('contact_person_phone')->nullable();
            $table->string('registration_no')->nullable();
            $table->string('medical_superintendent_firstname')->nullable();
            $table->string('medical_superintendent_lastname')->nullable();
            $table->string('medical_superintendent_email')->nullable();
            $table->string('medical_superintendent_registration_no')->nullable();
            $table->string('medical_superintendent_qualification')->nullable();
            $table->string('medical_superintendent_mobile')->nullable();
            $table->string('pollution_clearance_certificate')->nullable();
            $table->string('fire_safety_clearance_certificate')->nullable();
            $table->string('certificate_of_incorporation')->nullable();
            $table->string('bank_name')->nullable();
            $table->text('bank_address')->nullable();
            $table->text('bank_account_no')->nullable();
            $table->string('bank_ifs_code')->nullable();
            $table->string('cancel_cheque')->nullable();
            $table->string('tariff_list_soc')->nullable();
            $table->string('nabh_registration_no')->nullable();
            $table->string('nabl_registration_no')->nullable();
            $table->string('signed_mous')->nullable();
            $table->string('other_documents')->nullable();
            $table->string('hrms_software')->nullable();
            $table->string('iso_status')->nullable();
            $table->tinyInteger('status')->unsigned()->default(1)->nullable();
            $table->longText('comments')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospitals');
    }
};
