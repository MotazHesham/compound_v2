<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentCovenantsTable extends Migration
{
    public function up()
    {
        Schema::create('appointment_covenants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
