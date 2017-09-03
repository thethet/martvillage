<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblPrices extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('prices', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('compancy_id');
			$table->integer('category_id');
			$table->integer('currency_id');
			$table->string('title_name');
			$table->integer('from_country');
			$table->integer('from_state');
			$table->integer('to_country');
			$table->integer('to_state');
			$table->double('unit_price', 12, 2);
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
		Schema::drop('prices');
	}
}
