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
        Schema::table('towns', function (Blueprint $table) {
            $table->renameColumn('countries_id', 'country_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('towns', function (Blueprint $table) {
            $table->renameColumn('country_id', 'countries_id');
        });
    }
};
