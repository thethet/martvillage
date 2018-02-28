<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSenders extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('senders', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('company_id');
			$table->string('name');
			$table->string('nric_no', 50)->nullable();
			$table->integer('nric_code_id');
			$table->integer('nric_township_id');
			$table->string('contact_no')->unique();
			$table->string('member_no')->nullable();
			$table->integer('state_id');
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
		Schema::drop('senders');
	}
}
