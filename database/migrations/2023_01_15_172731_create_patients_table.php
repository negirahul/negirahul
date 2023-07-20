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

        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->nullable();
            $table->string('title')->nullable();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('dob')->nullable();
            $table->string('age')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->default('Male');
            $table->string('occupation')->nullable();
            $table->string('specify')->nullable();
            $table->string('patient_current_address')->nullable();
            $table->string('patient_current_city')->nullable();
            $table->string('patient_current_state')->nullable();
            $table->string('patient_current_pincode')->nullable();
            $table->string('current_permanent_address_same')->nullable();
            $table->string('patient_permanent_address')->nullable();
            $table->string('patient_permanent_city')->nullable();
            $table->string('patient_permanent_state')->nullable();
            $table->string('patient_permanent_pincode')->nullable();
            $table->string('id_proof')->nullable();
            $table->integer('hospital_id')->nullable();
            $table->string('hospital_name')->nullable();
            $table->string('hospital_address')->nullable();
            $table->string('hospital_city')->nullable();
            $table->string('hospital_state')->nullable();
            $table->string('hospital_pincode')->nullable();
            $table->string('associate_partner_id')->nullable();
            $table->string('registration_number')->nullable();
            $table->integer('treating_doctor')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('code')->nullable();
            $table->string('landline')->nullable();
            $table->string('referred_by')->nullable();
            $table->string('referral_name')->nullable();
            $table->string('admitted_by')->nullable();
            $table->string('admitted_by_title')->nullable();
            $table->string('admitted_by_firstname')->nullable();
            $table->string('admitted_by_middlename')->nullable();
            $table->string('admitted_by_lastname')->nullable();
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
        Schema::dropIfExists('patients');
    }
};
