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
        Schema::create('discharge_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('claimant_id')->nullable();
            $table->string('hospital_id')->nullable();
            $table->string('patient_id')->nullable();
            $table->string('claim_id')->nullable();
            $table->enum('injury_reason', ['Self Inflected', 'Road Traffic Accident', 'Substance Abuse-Alcohol Consumption'])->nullable();
            $table->enum('injury_due_to_substance_abuse_alcohol_consumption', ['Yes', 'No'])->nullable();
            $table->string('injury_due_to_substance_abuse_alcohol_consumption_file')->nullable();
            $table->enum('if_medico_legal_case_mlc', ['Yes', 'No'])->nullable();
            $table->enum('reported_to_police', ['Yes', 'No'])->nullable();
            $table->enum('mlc_report_and_police_fir_attached', ['Yes', 'No'])->nullable();
            $table->string('mlc_report_and_police_fir_attached_file')->nullable();
            $table->string('fir_or_mlc_no')->nullable();
            $table->string('not_reported_to_police_reason')->nullable();
            $table->string('maternity_date_of_delivery')->nullable();
            $table->string('maternity_gravida_status_g')->nullable();
            $table->string('maternity_gravida_status_p')->nullable();
            $table->string('maternity_gravida_status_l')->nullable();
            $table->string('maternity_gravida_status_a')->nullable();
            $table->enum('premature_baby', ['Yes', 'No'])->nullable();
            $table->string('date_of_discharge')->nullable();
            $table->time('time_of_discharge')->nullable();
            $table->enum('discharge_status', ['Discharge to Home', 'Discharge to another Hospital', 'Deceased', 'LAMA'])->nullable();
            $table->text('death_summary')->nullable();
            $table->string('death_summary_file')->nullable();
            $table->text('discharge_status_comments')->nullable();
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
        Schema::dropIfExists('discharge_statuses');
    }
};
