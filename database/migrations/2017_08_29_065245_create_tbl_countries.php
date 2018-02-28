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
			$table->string('country_name');
			$table->string('description')->nullable();
			$table->string('country_code')->nullable();
			$table->integer('total_cities');
			$table->enum('deleted', ['N', 'Y']);
			$table->integer('created_by');
			$table->integer('updated_by');
			$table->integer('deleted_by');
			$table->timestamps();
		});

		// Create table for associating countries to companies (Many-to-Many)
		Schema::create('companies_countries', function (Blueprint $table) {
			$table->integer('companies_id')->unsigned();
			$table->integer('countries_id')->unsigned();

			$table->foreign('companies_id')->references('id')->on('companies')
				->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('countries_id')->references('id')->on('countries')
				->onUpdate('cascade')->onDelete('cascade');

			$table->primary(['companies_id', 'countries_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('companies_countries');
		Schema::drop('countries');
	}
}
