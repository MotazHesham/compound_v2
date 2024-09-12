<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTechniciansTable extends Migration
{
    public function up()
    {
        Schema::table('technicians', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_10115109')->references('id')->on('users');
            $table->unsignedBigInteger('technician_type_id')->nullable();
            $table->foreign('technician_type_id', 'technician_type_fk_10115118')->references('id')->on('technician_types');
        });
    }
}
