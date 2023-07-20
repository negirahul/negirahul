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
        Schema::create('hospital_infrastructures', function (Blueprint $table) {
            $table->id();
            $table->integer('hospital_id')->unsigned()->nullable();
            $table->enum('city_category', ['I', 'II', 'III', 'Other'])->default('Other');
            $table->string('hospital_type')->nullable();
            $table->string('hospital_category')->nullable();
            $table->string('no_of_beds',)->nullable();
            $table->string('no_of_ots',)->nullable();
            $table->string('no_of_modular_ots',)->nullable();
            $table->string('no_of_icus',)->nullable();
            $table->string('no_of_iccus',)->nullable();
            $table->string('no_of_nicus',)->nullable();
            $table->string('no_of_rmos',)->nullable();
            $table->string('no_of_nurses',)->nullable();
            $table->string('nabl_approved_lab',)->nullable();
            $table->string('no_of_dialysis_units',)->nullable();
            $table->string('no_ambulance_normal',)->nullable();
            $table->string('no_ambulance_acls',)->nullable();
            $table->enum('nabh_status', ['Approved', 'Pre Approved', 'Applied', 'NA'])->default('NA');
            $table->enum('jci_status', ['Yes', 'No', 'Applied'])->default('No');
            $table->enum('nqac_nhsrc_status', ['Approved', 'Pre Approved', 'Applied', 'NA'])->default('NA');
            $table->enum('hippa_status', ['Yes', 'No'])->default('No');
            $table->longText('comments')->nullable();
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
        Schema::dropIfExists('hospital_infrastructures');
    }
};
