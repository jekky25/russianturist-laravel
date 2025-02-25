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
		Schema::table('hotels', function (Blueprint $table) {
			$table->renameColumn('hotels_name', 'name');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('hotels', function (Blueprint $table) {
			$table->renameColumn('name', 'hotels_name');
		});
	}
};
