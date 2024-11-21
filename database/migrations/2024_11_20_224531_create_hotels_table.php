<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id('hotels_id');
            $table->string('hotels_name');
            $table->string('hotels_eng_name')->unique();
            $table->integer('countries_id')->default(0);
            $table->text('hotels_description');
            $table->integer('hotels_time')->default(0);
            $table->tinyInteger('stars')->default(0);
            $table->integer('towns_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
