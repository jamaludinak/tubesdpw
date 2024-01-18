<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('room_name')->nullable();
            $table->string('food')->nullable();
            $table->string('bed_count')->nullable();
            $table->double('rent')->nullable();
            $table->timestamps();
        });

        DB::table('room_types')->insert([
            ['room_name' => 'Single', 'food' => 'No Free Food', 'bed_count' => '1', 'rent' => 250000],
            ['room_name' => 'Double', 'food' => 'Free Welcome Drink', 'bed_count' => '2', 'rent' => 400000],
            ['room_name' => 'Queen', 'food' => 'Free Breakfast', 'bed_count' => '3', 'rent' => 700000],
            ['room_name' => 'King', 'food' => 'Free Breakfast & Dinner', 'bed_count' => '4', 'rent' => 1000000],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_types');
    }
}
