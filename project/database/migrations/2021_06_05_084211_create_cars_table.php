<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('carMake')->nullable();
            $table->string('carModel');
            $table->string('PhoneNumber');
            $table->string('price');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');;
            $table->string('documents');
            $table->string('description');
            $table->string('carArea');
            $table->string('photo');
            $table->string('ifRented')->default('no');
            $table->string('status')->default('Under consideration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
