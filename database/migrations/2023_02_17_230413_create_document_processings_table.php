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
        Schema::create('document_processings', function (Blueprint $table) {
            $table->id();
            $table->string('patient_firstname')->nullable();
            $table->string('patient_lastname')->nullable();
            $table->date('patient_dob')->nullable();
            $table->enum('patient_gender', ['Male', 'Female', 'Unisex'])->nullable();
            $table->longText('patient_address')->nullable();
            $table->string('patient_city')->nullable();
            $table->string('patient_state')->nullable();
            $table->string('patient_pincode')->nullable();
            $table->string('patient_id_proof')->nullable();
            $table->string('patient_id_proof_file')->nullable();
            $table->string('contact_number')->nullable(); 
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
        Schema::dropIfExists('document_processings');
    }
};
