<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('username')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('user_type')->nullable();
            $table->string('identity_num')->nullable();
            $table->string('nationality')->nullable();
            $table->string('contract_type')->nullable();
            $table->string('job_num')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_field')->nullable();
            $table->string('commerical_num')->nullable();
            $table->string('manager_name')->nullable();
            $table->string('manager_phone')->nullable();
            $table->string('manager_email')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_website')->nullable();
            $table->string('contract_by')->nullable();
            $table->date('contract_start')->nullable();
            $table->date('contract_end')->nullable();
            $table->string('commissioner_name')->nullable();
            $table->string('commissioner_nationality')->nullable();
            $table->string('commissioner_id_number')->nullable();
            $table->date('commissioner_id_start')->nullable();
            $table->date('commissioner_id_end')->nullable();
            $table->string('commissioner_job')->nullable();
            $table->string('commissioner_phone')->nullable();
            $table->string('commissioner_email')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}