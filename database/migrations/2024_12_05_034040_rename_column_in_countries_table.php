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
		Schema::table('countries', function (Blueprint $table) {
            $table->renameColumn('countries_name', 'name');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('countries', function (Blueprint $table) {
			$table->renameColumn('name', 'countries_name');
		});
	}
};