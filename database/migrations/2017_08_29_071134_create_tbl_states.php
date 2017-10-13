<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblStates extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('states', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('country_id');
			$table->string('state_name');
			$table->string('description')->nullable();
			$table->string('state_code')->nullable();
			$table->enum('deleted', ['N', 'Y']);
			$table->integer('created_by');
			$table->integer('updated_by');
			$table->timestamps();
		});

		// Create table for associating states to companies (Many-to-Many)
		Schema::create('companies_states', function (Blueprint $table) {
			$table->integer('companies_id')->unsigned();
			$table->integer('states_id')->unsigned();

			$table->foreign('companies_id')->references('id')->on('companies')
				->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('states_id')->references('id')->on('states')
				->onUpdate('cascade')->onDelete('cascade');

			$table->primary(['companies_id', 'states_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('companies_states');
		Schema::drop('states');
	}
}
