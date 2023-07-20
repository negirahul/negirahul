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
        Schema::create('hospital_departments', function (Blueprint $table) {
            $table->id();
            $table->integer('hospital_id')->unsigned()->nullable();
            $table->enum('specialization', ['ENT', 'Dental', 'Ophthalmology', 'Orthopaedic', 'Gyne', 'Paediatric', 'Neonatology', 'Perinatology', 'Nephrology', 'Hepatology', 'Neurology', 'Cardiac', 'Oncology', 'Gastroenterolog'])->default('Gastroenterolog');
            $table->string('doctors_firstname')->nullable();
            $table->string('doctors_lastname')->nullable();
            $table->string('registration_no')->nullable();
            $table->string('email_id',)->nullable();
            $table->string('doctors_mobile_no',)->nullable();
            $table->string('upload',)->nullable();
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
        Schema::dropIfExists('hospital_departments');
    }
};
