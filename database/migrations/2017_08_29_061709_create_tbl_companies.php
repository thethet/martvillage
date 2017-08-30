<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblCompanies extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('companies', function (Blueprint $table) {
			$table->increments('id');
			$table->string('company_name');
			$table->string('contact_no')->nullable();
			$table->string('fax')->nullable();
			$table->string('email')->unique();
			$table->string('logo');
			$table->string('unit_number', 50)->nullable();
			$table->string('building_name', 100)->nullable();
			$table->string('street')->nullable();
			$table->integer('country_id');
			$table->integer('state_id');
			$table->integer('township_id');
			$table->text('address')->nullable();
			$table->text('location')->nullable();
			$table->date('expiry_date');
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
		Schema::drop('companies');
	}
}
