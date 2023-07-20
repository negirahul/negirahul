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
        Schema::create('sales_service_types', function (Blueprint $table) {
            $table->id();
            $table->integer('associate_partner_id')->unsigned();
            $table->string('consulting')->nullable();
            $table->string('consulting_charge')->nullable();
            $table->longText('consulting_comment')->nullable();
            $table->string('dealer_distributor')->nullable();
            $table->string('dealer_distributor_charge')->nullable();
            $table->longText('dealer_distributor_comment')->nullable();
            $table->string('hospital_empanelment_agent')->nullable();
            $table->string('hospital_empanelment_agent_charge')->nullable();
            $table->longText('hospital_empanelment_agent_comment')->nullable();
            $table->string('software_sales')->nullable();
            $table->string('software_sales_charge')->nullable();
            $table->longText('software_sales_comment')->nullable();
            $table->string('others')->nullable();
            $table->string('others_charge')->nullable();
            $table->longText('others_comment')->nullable();
            $table->longText('sales_partner_comments')->nullable();
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
        Schema::dropIfExists('sales_service_types');
    }
};
