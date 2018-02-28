<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblMembers extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('members', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('company_id');
			$table->integer('member_offers_id');
			$table->string('name');
			$table->date('dob');
			$table->string('nric_no', 50)->nullable();
			$table->integer('nric_code_id');
			$table->integer('nric_township_id');
			$table->enum('gender', ['Female', 'Male']);
			$table->enum('marital_status', ['Single', 'Married', 'Separated', 'Divorced', 'Widowed', 'Single Parent']);
			$table->string('contact_no')->unique();
			$table->string('member_no')->unique();
			$table->string('email')->unique();
			$table->string('unit_number', 50)->nullable();
			$table->string('building_name', 100)->nullable();
			$table->string('street')->nullable();
			$table->integer('country_id');
			$table->integer('state_id');
			$table->integer('township_id');
			$table->text('address')->nullable();
			$table->enum('deleted', ['N', 'Y']);
			$table->integer('created_by');
			$table->integer('updated_by');
			$table->integer('deleted_by');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('members');
	}
}
