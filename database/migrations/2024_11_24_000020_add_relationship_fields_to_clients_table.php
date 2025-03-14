<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToClientsTable extends Migration
{
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_10108726')->references('id')->on('users');
            $table->unsignedBigInteger('property_type_id')->nullable();
            $table->foreign('property_type_id', 'property_type_fk_10283193')->references('id')->on('property_types');
        });
    }
}