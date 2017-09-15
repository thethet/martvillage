<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblCountries extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('countries', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('company_id');
			$table->string('country_name');
			$table->string('description')->nullable();
			$table->string('country_code')->nullable();
			$table->integer('total_cities');
			$table->enum('deleted', ['N', 'Y']);
			$table->integer('created_by');
			$table->integer('updated_by');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('countries');
	}
}
