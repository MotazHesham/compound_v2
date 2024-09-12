<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCovenantsTable extends Migration
{
    public function up()
    {
        Schema::table('covenants', function (Blueprint $table) {
            $table->unsignedBigInteger('technician_id')->nullable();
            $table->foreign('technician_id', 'technician_fk_10115205')->references('id')->on('technicians');
        });
    }
}
