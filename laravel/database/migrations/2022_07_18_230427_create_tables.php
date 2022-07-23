<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_species', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20)->unique();
        });
        Schema::create('pet_race', function (Blueprint $table) {
            $table->id();
            $table->string('race', 30)->nullable();
            $table->unsignedBigInteger('species_id');

            $table->foreign('species_id')->references('id')->on('pet_species');
            $table->unique(['race', 'species_id']);
        });
        Schema::create('pet', function (Blueprint $table) {
            $table->id();
            $table->longText('annotations')->nullable();
            $table->date('birthday')->nullable();
            $table->string('name', 30);
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->unsignedBigInteger('race_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('race_id')->references('id')->on('pet_race');
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::create('appointment', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->longText('annotations')->nullable();
            $table->unsignedBigInteger('pet_id');
            $table->unsignedBigInteger('vet_id');
            $table->timestamps();

            $table->foreign('pet_id')->references('id')->on('pet');
            $table->foreign('vet_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment');
        Schema::dropIfExists('pet');
        Schema::dropIfExists('pet_race');
        Schema::dropIfExists('pet_species');
    }
};
