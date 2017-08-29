<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('company_id');
			$table->string('name');
			$table->string('nric_no', 50);
			$table->integer('nric_code_id');
			$table->integer('nric_township_id');
			$table->enum('marital_status', ['Single', 'Married', 'Separated', 'Divorced', 'Widowed', 'Single Parent']);
			$table->string('contact_no');
			$table->string('position');
			$table->integer('nationality');
			$table->string('email')->unique();
			$table->string('username')->unique();
			$table->string('password');
			$table->string('unit_number', 50);
			$table->string('building_name', 100);
			$table->string('street');
			$table->integer('country_id');
			$table->integer('state_id');
			$table->integer('township_id');
			$table->text('address');
			$table->string('photo');
			$table->enum('deleted', ['N', 'Y']);
			$table->integer('created_by');
			$table->integer('updated_by');
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('users');
	}
}
