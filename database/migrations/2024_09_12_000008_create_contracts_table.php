<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('chosen_day');
            $table->string('time');
            $table->integer('num_of_visits');
            $table->longText('services')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
