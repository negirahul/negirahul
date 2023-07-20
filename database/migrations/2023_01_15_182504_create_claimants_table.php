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
        
        Schema::create('claimants', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->nullable();
            $table->string('patient_id')->nullable();
            $table->string('claim_id')->nullable();
            $table->string('associate_partner_id')->nullable();
            $table->string('hospital_id')->nullable();            
            $table->enum('policy_type',['Group','Retail'])->nullable();
            $table->string('group_name')->nullable();
            $table->string('employee_id_or_member_id')->nullable();
            $table->string('are_patient_and_claimant_same')->nullable();
            $table->string('title')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('patients_relation_with_claimant')->nullable();
            $table->string('please_specify')->nullable();
            $table->string('address')->nullable();
            $table->string('specify')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('personal_email_id')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('official_email_id')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('cancel_cheque')->nullable();
            $table->string('estimated_amount')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_address')->nullable();           
            $table->string('ac_no')->nullable();           
            $table->string('ifs_code')->nullable();           
            $table->string('comments')->nullable();  
            $table->tinyInteger('status')->unsigned()->default(1)->nullable();         
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
        Schema::dropIfExists('claimants');
    }
};
