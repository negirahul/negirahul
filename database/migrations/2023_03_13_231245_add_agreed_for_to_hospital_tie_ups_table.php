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
        Schema::table('hospital_tie_ups', function (Blueprint $table) {
            $table->enum('agreed_for',['Claims Servicing', 'ClaimStack2.O', 'Both'])->nullable()->after('referral');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hospital_tie_ups', function (Blueprint $table) {
            $table->dropColumn('agreed_for');
        });
    }
};
