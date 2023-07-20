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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('avatar')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('uid')->unique();
            $table->string('employee_code')->nullable();
            $table->string('designation')->nullable();
            $table->string('phone')->nullable();
            $table->enum('linked_with_superadmin', ['yes', 'no'])->default('no');
            $table->string('department')->nullable();
            $table->string('kra')->nullable();
            $table->string('linked_employee')->nullable();
            $table->string('linked_employee_id')->nullable();
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
        Schema::dropIfExists('users');
    }
};
