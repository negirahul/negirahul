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
        Schema::create('associate_partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('associate_partner_id')->nullable();
            $table->enum('type', ['vendor', 'sales'])->default('vendor');
            $table->string('pan')->nullable();
            $table->string('avatar')->nullable();
            $table->string('panfile')->nullable();
            $table->string('owner_firstname')->nullable();
            $table->string('owner_lastname')->nullable();
            $table->string('email')->unique();
            $table->longText('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('phone')->nullable();
            $table->longText('reference')->nullable();
            $table->enum('status', ['Main', 'Sub AP', 'Agency'])->default('Main');
            $table->string('linked_associate_partner')->nullable();
            $table->string('linked_associate_partner_id')->nullable();
            $table->string('assigned_employee_department')->nullable();
            $table->string('assigned_employee')->nullable();
            $table->string('assigned_employee_id')->nullable();
            $table->string('linked_employee_department')->nullable();
            $table->string('linked_employee')->nullable();
            $table->string('linked_employee_id')->nullable();
            $table->enum('mou', ['yes', 'no'])->default('no');
            $table->string('moufile')->nullable();
            $table->date('agreement_start_date')->nullable();
            $table->string('agreementfile')->nullable();
            $table->date('agreement_end_date')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_person_phone')->nullable();
            $table->string('contact_person_email')->nullable();
            $table->string('bank_name')->nullable();
            $table->text('bank_address')->nullable();
            $table->text('bank_account_no')->nullable();
            $table->string('bank_ifs_code')->nullable();
            $table->string('cancel_cheque')->nullable();
            $table->string('cancel_cheque_file')->nullable();
            $table->longText('comments')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('associate_partners');
    }
};
