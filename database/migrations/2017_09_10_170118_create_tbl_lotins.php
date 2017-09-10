<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblLotins extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('lotins', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('company_id');
			$table->integer('user_id');
			$table->integer('sender_id');
			$table->integer('receiver_id');
			$table->string('lot_no');
			$table->date('date');
			$table->time('time');
			$table->integer('from_country');
			$table->integer('from_state');
			$table->string('item_name');
			$table->string('barcode');
			$table->integer('price_id');
			$table->integer('category_id');
			$table->string('unit');
			$table->double('unit_price', 12, 2);
			$table->integer('quantity');
			$table->double('amount', 12, 2);
			$table->double('member_discount', 5, 2);
			$table->double('member_discount_amt', 12, 2);
			$table->double('other_discount', 5, 2);
			$table->double('other_discount_amt', 12, 2);
			$table->double('gov_tax', 5, 2);
			$table->double('gov_tax_amt', 12, 2);
			$table->enum('status', [0, 1, 2, 3, 4]);
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
		Schema::drop('lotins');
	}
}
