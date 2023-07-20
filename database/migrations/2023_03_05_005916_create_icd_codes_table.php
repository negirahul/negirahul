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
        Schema::create('icd_codes', function (Blueprint $table) {
            $table->id();
            $table->string('level4_code')->index()->nullable();
            $table->string('level3_code')->index()->nullable();
            $table->string('level2_code')->index()->nullable();
            $table->string('level1_code')->index()->nullable();
            $table->string('level4')->index()->nullable();
            $table->string('level3')->index()->nullable();
            $table->string('level2')->index()->nullable();
            $table->string('level1')->index()->nullable();
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
        Schema::dropIfExists('icd_codes');
    }
};
