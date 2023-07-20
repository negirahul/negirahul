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
        Schema::create('assessment_part_ones', function (Blueprint $table) {
            $table->id();
            $table->integer('claim_id');
            $table->string('balance_sum_insured')->nullable();
            $table->string('co_payment')->nullable();
            $table->string('sub_limit')->nullable();
            $table->string('no_claim_bonus')->nullable();
            $table->string('effective_coverage')->nullable();
            $table->string('buffer_limit')->nullable();
            $table->string('eligible_icu_ccu_rent')->nullable();
            $table->string('eligible_room')->nullable();
            $table->string('patient_signature')->nullable();
            $table->string('patient_signature_date')->nullable();
            $table->string('relation_with_patient')->nullable();
            $table->string('officer_signature')->nullable();
            $table->string('officer_signature_date')->nullable();
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
        Schema::dropIfExists('assessment_part_ones');
    }
};
