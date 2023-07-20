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
        Schema::create('dependent_insureds', function (Blueprint $table) {
            $table->id();
            $table->integer('insurance_policy_id');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();
            $table->string('relation')->nullable();
            $table->double('sum_insured')->nullable();
            $table->string('cumulative_bonus')->nullable();
            $table->double('balance_sum_insured')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('dependent_insureds');
    }
};
