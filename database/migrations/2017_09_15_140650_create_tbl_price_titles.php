<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblPriceTitles extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('price_titles', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('company_id');
			$table->string('title_name');
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
		Schema::drop('price_titles');
	}
}
