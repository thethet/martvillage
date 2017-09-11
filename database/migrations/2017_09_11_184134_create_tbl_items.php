<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblItems extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('items', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('lotin_id');
			$table->string('item_name');
			$table->string('barcode');
			$table->integer('price_id');
			$table->integer('category_id');
			$table->string('unit');
			$table->double('unit_price', 12, 2);
			$table->integer('quantity');
			$table->double('amount', 12, 2);
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
		Schema::drop('items');
	}
}
