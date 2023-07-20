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
        Schema::create('assessment_part_twos', function (Blueprint $table) {
            $table->id();
            $table->integer('claim_id');
            $table->string('present_ailment_duration')->nullable();
            $table->string('pastHitory')->nullable();
            $table->string('Diabetes')->nullable();
            $table->string('DiabetesDate')->nullable();
            $table->string('HTN')->nullable();
            $table->string('HTNDate')->nullable();
            $table->string('Alcohol')->nullable();
            $table->string('AlcoholDate')->nullable();
            $table->string('Smoking')->nullable();
            $table->string('SmokingDate')->nullable();
            $table->string('Drug')->nullable();
            $table->string('DrugDate')->nullable();
            $table->string('Heart')->nullable();
            $table->string('HeartDate')->nullable();
            $table->string('Kidney')->nullable();
            $table->string('KidneyDate')->nullable();
            $table->string('Liver')->nullable();
            $table->string('LiverDate')->nullable();
            $table->string('Arthritis')->nullable();
            $table->string('ArthritisDate')->nullable();
            $table->string('Neuro')->nullable();
            $table->string('NeuroDate')->nullable();
            $table->string('Hear')->nullable();
            $table->string('HearDate')->nullable();
            $table->string('Hypertension')->nullable();
            $table->string('HypertensionDate')->nullable();
            $table->string('Hyperlipidaemias')->nullable();
            $table->string('HyperlipidaemiasDate')->nullable();
            $table->string('Osteoarthritis')->nullable();
            $table->string('OsteoarthritisDate')->nullable();
            $table->string('Asthma')->nullable();
            $table->string('AsthmaDate')->nullable();
            $table->string('Cancer')->nullable();
            $table->string('CancerDate')->nullable();
            $table->string('HIV')->nullable();
            $table->string('HIVDate')->nullable();
            $table->string('Any_other_ailment')->nullable();
            $table->string('Any_other_ailment_Date')->nullable();
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
        Schema::dropIfExists('assessment_part_twos');
    }
};
