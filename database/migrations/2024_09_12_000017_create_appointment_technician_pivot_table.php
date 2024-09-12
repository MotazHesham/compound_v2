<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentTechnicianPivotTable extends Migration
{
    public function up()
    {
        Schema::create('appointment_technician', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_id');
            $table->foreign('appointment_id', 'appointment_id_fk_10115121')->references('id')->on('appointments')->onDelete('cascade');
            $table->unsignedBigInteger('technician_id');
            $table->foreign('technician_id', 'technician_id_fk_10115121')->references('id')->on('technicians')->onDelete('cascade');
        });
    }
}
