<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentEditRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('appointment_edit_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->time('time');
            $table->string('status');
            $table->longText('reject_reason')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_10511540')->references('id')->on('users');
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->foreign('appointment_id', 'appointment_fk_10511541')->references('id')->on('appointments');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}