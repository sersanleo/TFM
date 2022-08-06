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
        Schema::create('pet_races', function (Blueprint $table) {
            $table->id();
            $table->string('race', 30);
            $table->unsignedBigInteger('species_id');

            $table->foreign('species_id')->references('id')->on('pet_species');
            $table->unique(['race', 'species_id']);
        });
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->longText('annotations')->nullable();
            $table->date('birthday')->nullable();
            $table->string('name', 30);
            $table->enum('sex', ['M', 'F'])->nullable();
            $table->boolean('deceased')->default(false);
            $table->unsignedBigInteger('race_id')->nullable();
            $table->unsignedBigInteger('owner_id');
            $table->timestamps();

            $table->foreign('race_id')->references('id')->on('pet_races')->nullOnDelete();
            $table->foreign('owner_id')->references('id')->on('users');
        });
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->longText('annotations')->nullable();
            $table->unsignedBigInteger('pet_id');
            $table->unsignedBigInteger('vet_id');
            $table->timestamps();

            $table->foreign('pet_id')->references('id')->on('pets')->cascadeOnDelete();
            $table->foreign('vet_id')->references('id')->on('users');
            $table->unique(['date', 'vet_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('pets');
        Schema::dropIfExists('pet_races');
        Schema::dropIfExists('pet_species');
    }
};
