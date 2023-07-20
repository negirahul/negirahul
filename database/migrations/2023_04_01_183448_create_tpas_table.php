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
        Schema::create('tpas', function (Blueprint $table) {
            $table->id();
            $table->string('company')->nullable();
            $table->string('company_type')->nullable();
            $table->string('claim_reimbursement_form')->nullable();
            $table->string('cashless_pre_authorization_request_form')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('tpas');
    }
};
