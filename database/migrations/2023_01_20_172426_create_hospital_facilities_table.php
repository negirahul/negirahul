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
        Schema::create('hospital_facilities', function (Blueprint $table) {
            $table->id();
            $table->integer('hospital_id')->unsigned()->nullable();
            $table->enum('pharmacy', ['Yes', 'No'])->nullable();
            $table->enum('lab', ['Yes', 'No'])->nullable();
            $table->enum('ambulance', ['Yes', 'No'])->nullable();
            $table->enum('operation_theatre', ['Yes', 'No'])->nullable();
            $table->enum('icu', ['Yes', 'No'])->nullable();
            $table->enum('iccu', ['Yes', 'No'])->nullable();
            $table->enum('nicu', ['Yes', 'No'])->nullable();
            $table->enum('csc_sterilization', ['Yes', 'No'])->nullable();
            $table->enum('centralized_gas_ons', ['Yes', 'No'])->nullable();
            $table->enum('centralized_ac', ['Yes', 'No'])->nullable();
            $table->enum('kitchen', ['Yes', 'No'])->nullable();
            $table->enum('usg_machine', ['Yes', 'No'])->nullable();
            $table->enum('digital_xray', ['Yes', 'No'])->nullable();
            $table->enum('ct', ['Yes', 'No'])->nullable();
            $table->enum('mri', ['Yes', 'No'])->nullable();
            $table->enum('pet_scan', ['Yes', 'No'])->nullable();
            $table->enum('organ_transplant_unit', ['Yes', 'No'])->nullable();
            $table->enum('burn_unit', ['Yes', 'No'])->nullable();
            $table->enum('dialysis_unit', ['Yes', 'No'])->nullable();
            $table->enum('blood_bank', ['Yes', 'No'])->nullable();
            $table->string('hospital_facility_comments')->nullable();
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
        Schema::dropIfExists('hospital_facilities');
    }
};
