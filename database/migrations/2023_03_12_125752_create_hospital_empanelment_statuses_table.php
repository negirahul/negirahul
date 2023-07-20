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
        Schema::create('hospital_empanelment_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('hospital_id')->nullable();
            $table->string('tpa_id')->nullable();
            $table->string('company_type')->nullable();
            $table->enum('empanelled', ['Yes', 'No'])->nullable();
            $table->string('empanelled_file')->nullable();
            $table->string('hospital_id_as_per_the_selected_company')->nullable();
            $table->enum('signed_mou', ['Yes', 'No'])->nullable();
            $table->string('signed_mou_file')->nullable();
            $table->enum('agreed_packages_and_tariff_pdf_other_images', ['Yes', 'As Per Hospital Tariff'])->nullable();
            $table->string('agreed_packages_and_tariff_pdf_other_images_file')->nullable();
            $table->enum('upload_packages_and_tariff_excel_or_csv', ['Yes', 'No'])->nullable();
            $table->string('upload_packages_and_tariff_excel_or_csv_file')->nullable();
            $table->enum('negative_listing_status', ['Yes', 'No'])->nullable();
            $table->string('negative_listing_status_file')->nullable();
            $table->text('hospital_empanelment_status_comments')->nullable();
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
        Schema::dropIfExists('hospital_empanelment_statuses');
    }
};
