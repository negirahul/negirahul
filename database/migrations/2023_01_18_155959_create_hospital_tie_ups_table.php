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
        Schema::create('hospital_tie_ups', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->nullable();            
            $table->integer('hospital_id')->unsigned()->nullable();
            $table->string('mou_inception_date')->nullable();
            $table->enum('bhc_packages_for_surgical_procedures_accepted', ['Yes','No'])->nullable();
            $table->enum('discount_on_medical_management_cases', ['Yes','No'])->nullable();
            $table->integer('discount_on_final_bill')->default(0);
            $table->integer('discount_on_room_rent')->default(0);
            $table->integer('discount_on_medicines')->default(0);
            $table->integer('discount_on_consumables')->default(0);
            $table->enum('referral_commission_offered',['Yes','No'])->nullable();
            $table->integer('referral')->default(0);
            $table->enum('claimstag_usage_services',['Monthly','Half Yearly','Quarterly', 'Yearly','Pre Use','No'])->nullable();
            $table->double('claimstag_installation_charges')->default(0);
            $table->double('claimstag_usage_charges')->default(0);
            $table->enum('claims_reimbursement_insured_services', ['Monthly','Half Yearly','Quarterly', 'Yearly','Pre Use','No'])->nullable();
            $table->integer('claims_reimbursement_insured_service_charges')->default(0);
            $table->enum('cashless_claims_management_services', ['Monthly','Half Yearly','Quarterly', 'Yearly','Pre Use','No'])->nullable();
            $table->double('cashless_claims_management_services_charges')->default(0);
            $table->enum('medical_lending_for_patients', ['Yes','No'])->nullable();
            $table->enum('medical_lending_service_type',['Bridge','Term','Both'])->nullable();
            $table->integer('subvention')->default(0);
            $table->enum('medical_lending_for_bill_invoice_discounting', ['Yes','No'])->nullable();
            $table->string('comments_on_invoice_discounting')->nullable();
            $table->string('lending_finance_company_agreement')->nullable();
            $table->string('lending_finance_company_agreement_date')->nullable();
            $table->enum('hospital_management_system_installation', ['Yes','No'])->nullable();
            $table->enum('hms_services',['Monthly','Half Yearly','Quarterly', 'Yearly','Pre Use','No'])->nullable();
            $table->double('hms_charges')->default(0);
            $table->longText('comments')->nullable();           
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
        Schema::dropIfExists('hospital_tie_ups');
    }
};
