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
			$table->renameColumn('hotels_eng_name', 'slug');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('hotels', function (Blueprint $table) {
			$table->renameColumn('slug', 'hotels_eng_name');
		});
	}
};