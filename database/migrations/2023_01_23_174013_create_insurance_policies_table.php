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
        Schema::create('insurance_policies', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id')->nullable();
            $table->string('claim_id')->nullable();
            $table->string('policy_no')->nullable();
            $table->string('insurer_id')->nullable();
            $table->string('policy_id')->nullable();
            $table->string('certificate_no')->nullable();
            $table->string('company_tpa_id_card_no')->nullable();
            $table->string('tpa_name')->nullable();
            $table->enum('policy_type',['Group','Retail'])->nullable();
            $table->string('group_name')->nullable();
            $table->string('previous_policy_no')->nullable();
            $table->string('start_date')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('commencement_date')->nullable();
            $table->string('title')->nullable();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('is_primary_insured_and_patient_same')->nullable();
            $table->longText('primary_insured_address')->nullable();
            $table->string('primary_insured_city')->nullable();
            $table->string('primary_insured_state')->nullable();
            $table->string('primary_insured_pincode')->nullable();
            $table->integer('no_of_person_insured')->nullable();
            $table->integer('basic_sum_insured')->nullable();
            $table->integer('cumulative_bonus_cv')->nullable();
            $table->string('agent_broker_code')->nullable();
            $table->string('agent_broker_name')->nullable();
            $table->string('additional_policy')->nullable();
            $table->string('policy_no_additional')->nullable();
            $table->string('currently_covered')->nullable();
            $table->string('commencement_date_other')->nullable();
            $table->string('insurance_company_other')->nullable();
            $table->string('policy_no_other')->nullable();
            $table->integer('sum_insured_other')->nullable();
            $table->string('hospitalized')->nullable();
            $table->string('admission_date_past')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('comments')->nullable();
            $table->string('primary_insured_firstname')->nullable();
            $table->string('primary_insured_lastname')->nullable();
            $table->string('primary_insured_gender')->nullable();
            $table->string('primary_insured_age')->nullable();
            $table->string('primary_insured_relation')->nullable();
            $table->string('primary_insured_sum_insured')->nullable();
            $table->string('primary_insured_cumulative_bonus')->nullable();
            $table->string('primary_insured_balance_sum_insured')->nullable();
            $table->text('primary_insured_comment')->nullable();
            $table->string('dependent_insured_firstname')->nullable();
            $table->string('dependent_insured_lastname')->nullable();
            $table->string('dependent_insured_gender')->nullable();
            $table->string('dependent_insured_age')->nullable();
            $table->string('dependent_insured_relation')->nullable();
            $table->string('dependent_insured_sum_insured')->nullable();
            $table->string('dependent_insured_cumulative_bonus')->nullable();
            $table->string('dependent_insured_balance_sum_insured')->nullable();
            $table->text('dependent_insured_comment')->nullable();
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
        Schema::dropIfExists('insurance_policies');
    }
};
