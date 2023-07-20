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
        Schema::create('pcs_codes', function (Blueprint $table) {
            $table->id();
            $table->string('pcs_group_name')->index()->nullable();
            $table->string('pcs_group_code')->index()->nullable();
            $table->string('pcs_sub_group_name')->index()->nullable();
            $table->string('pcs_sub_group_code')->index()->nullable();
            $table->string('pcs_short_name')->index()->nullable();
            $table->string('pcs_code')->index()->nullable();
            $table->string('pcs_long_name')->index()->nullable();
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
        Schema::dropIfExists('pcs_codes');
    }
};
