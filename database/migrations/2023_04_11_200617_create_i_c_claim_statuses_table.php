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
        Schema::create('i_c_claim_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('claim_id')->nullable();
            $table->integer('claimant_id')->nullable();
            $table->integer('patient_id')->nullable();
            $table->string('patient_name')->nullable();
            $table->integer('hospital_id')->nullable();
            $table->string('hospital_name')->nullable();
            $table->string('associate_partner_name')->nullable();
            $table->string('insurance_co_name')->nullable();
            $table->string('policy_no')->nullable();
            $table->string('tpa_name')->nullable();
            $table->string('tpa_card_no')->nullable();
            $table->string('claim_intimation_no')->nullable();
            $table->string('date_receiving_main_claim_documents')->nullable();
            $table->string('date_dispatching_main_claim_documents_to_ic_or_tpa')->nullable();
            $table->string('date_receiving_pre_claim_documents')->nullable();
            $table->string('date_dispatching_pre_claim_documents_to_ic_or_tpa')->nullable();
            $table->string('date_receiving_post_claim_documents')->nullable();
            $table->string('date_dispatching_post_claim_documents_to_ic_or_tpa')->nullable();
            $table->string('date_receiving_query1_documents')->nullable();
            $table->string('date_dispatching_query1_documents_to_ic_or_tpa')->nullable();
            $table->string('date_receiving_query2_documents')->nullable();
            $table->string('date_dispatching_query2_documents_to_ic_or_tpa')->nullable();
            $table->string('date_receiving_query3_documents')->nullable();
            $table->string('date_dispatching_query3_documents_to_ic_or_tpa')->nullable();
            $table->enum('ic_claim_status', ['Waiting for the Claim Documents', 'Claim Documents Dispatched to IC-TPA', 'Waiting for Query Reply from Insured', 'Query Reply Dispatched to IC-TPA', 'Claim Settled', 'Claim Paid', 'Claim Rejected'])->nullable();
            $table->string('date_settlement')->nullable();
            $table->double('settled_amount')->nullable();
            $table->string('date_disbursement')->nullable();
            $table->text('ic_claim_status_comments')->nullable();
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
        Schema::dropIfExists('i_c_claim_statuses');
    }
};
