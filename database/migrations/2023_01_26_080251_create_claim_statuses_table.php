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
        Schema::create('claim_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('claim_id')->nullable();
            $table->string('claim_status')->nullable();
            $table->string('hospital_name')->nullable();
            $table->string('hospital_address')->nullable();
            $table->string('hospital_city')->nullable();
            $table->string('hospital_state')->nullable();
            $table->string('hospital_pincode')->nullable();
            $table->date('date_of_admission')->default(date("Y-m-d H:i:s"));
            $table->date('date_of_discharge')->default(date("Y-m-d H:i:s"));
            $table->double('final_amount')->default(0);
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
        Schema::dropIfExists('claim_statuses');
    }
};
