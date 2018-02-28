<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblCategories extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('categories', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('company_id');
			$table->string('name');
			$table->string('unit');
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
		Schema::drop('categories');
	}
}
