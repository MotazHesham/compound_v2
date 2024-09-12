<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->date('date');
            $table->time('time');
            $table->string('status')->nullable();
            $table->string('finish_code')->nullable();
            $table->longText('problem_description')->nullable();
            $table->longText('review')->nullable();
            $table->longText('cancel_reason')->nullable();
            $table->string('arrived_lat')->nullable();
            $table->string('arrived_lng')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
