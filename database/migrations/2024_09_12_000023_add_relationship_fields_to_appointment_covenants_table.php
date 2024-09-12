<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAppointmentCovenantsTable extends Migration
{
    public function up()
    {
        Schema::table('appointment_covenants', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->foreign('appointment_id', 'appointment_fk_10115221')->references('id')->on('appointments');
            $table->unsignedBigInteger('covenant_id')->nullable();
            $table->foreign('covenant_id', 'covenant_fk_10115222')->references('id')->on('covenants');
        });
    }
}
