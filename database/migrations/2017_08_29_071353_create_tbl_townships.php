<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblTownships extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('townships', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('state_id');
			$table->string('township_name');
			$table->string('description')->nullable();
			$table->string('code')->nullable();
			$table->enum('deleted', ['N', 'Y']);
			$table->integer('created_by');
			$table->integer('updated_by');
			$table->integer('deleted_by');
			$table->timestamps();
		});

		// Create table for associating townships to companies (Many-to-Many)
		Schema::create('companies_townships', function (Blueprint $table) {
			$table->integer('companies_id')->unsigned();
			$table->integer('townships_id')->unsigned();

			$table->foreign('companies_id')->references('id')->on('companies')
				->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('townships_id')->references('id')->on('townships')
				->onUpdate('cascade')->onDelete('cascade');

			$table->primary(['companies_id', 'townships_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('companies_townships');
		Schema::drop('townships');
	}
}
