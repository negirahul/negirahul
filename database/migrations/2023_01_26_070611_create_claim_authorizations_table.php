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
        Schema::create('claim_authorizations', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_admission')->default(date("Y-m-d H:i:s"));
            $table->date('date_of_discharge')->default(date("Y-m-d H:i:s"));
            $table->date('probable_date_of_admission')->default(date("Y-m-d H:i:s"));
            $table->date('probable_date_of_discharge')->default(date("Y-m-d H:i:s"));
            $table->enum('treatment_type',['OPD','IPD'])->default('IPD');
            $table->enum('admission_type',['Monthly','Half Yearly','Quarterly', 'Yearly','Pre Use','No'])->default('No');
            $table->enum('claim_category',['Cashless','Reimbursement'])->nullable('Reimbursement');
            $table->enum('treatment_category', ['Surgical', 'Medical Management'])->default('Surgical');
            $table->string('disease_name')->nullable();
            $table->enum('disease_category', ['Cardiac', 'Dialysis', 'Eye Related', 'Infection', 'Maternity ', 'Neuro Related', 'Trauma'])->default('Cardiac');
            $table->enum('disease_type', ['PED', 'Non-PED'])->default('PED');
            $table->string('icd')->nullable();
            $table->string('icd_code')->nullable();
            $table->string('pcs_group')->nullable();
            $table->string('insurance_company')->nullable();
            $table->string('plan_name')->nullable();
            $table->string('policy_condition')->nullable();
            $table->string('policy_document_file')->nullable();
            $table->string('policy_condition_file')->nullable();
            $table->string('claim_documents')->nullable();
            $table->string('claim_documents_file')->nullable();
            $table->string('claim_status_bhc')->nullable();
            $table->string('query1')->nullable();
            $table->string('query2')->nullable();
            $table->string('query3')->nullable();
            $table->string('second_level_authentication')->nullable();
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
        Schema::dropIfExists('claim_authorizations');
    }
};
