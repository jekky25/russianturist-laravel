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
		Schema::table('vars', function (Blueprint $table) {
			$table->integer('id')->first();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		if (Schema::hasColumn('vars', 'id')) {
			Schema::table('vars', function (Blueprint $table) {
				if (Schema::hasIndex('vars', ['id'], 'primary')) {
					$table->dropPrimary('id');
				} else
				{
					$table->dropColumn('id');
				}
			});
		}
	}
};