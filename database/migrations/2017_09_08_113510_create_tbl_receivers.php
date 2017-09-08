<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReceivers extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('receivers', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('company_id');
			$table->integer('sender_id');
			$table->string('name');
			$table->string('nric_no', 50)->nullable();
			$table->integer('nric_code_id');
			$table->integer('nric_township_id');
			$table->string('contact_no')->unique();
			$table->string('member_no')->unique();
			$table->integer('state_id');
			$table->text('address');
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
		Schema::drop('receivers');
	}
}
