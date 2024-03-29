<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('bkg_id');
            $table->string('name')->nullable();
            $table->string('room')->nullable();
            $table->string('total_numbers')->nullable();
            $table->double('rent')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('arrival_date')->nullable();
            $table->string('depature_date')->nullable();
            $table->string('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
