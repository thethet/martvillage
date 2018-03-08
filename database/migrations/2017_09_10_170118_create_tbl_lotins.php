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
			$table->integer('outgoing_id')->default(0);;
			$table->string('lot_no');
			$table->date('date');
			$table->time('time');
			$table->date('outgoing_date');
			$table->date('outgoing_arr_date');
			$table->date('incoming_date');
			$table->date('collected_date');
			$table->integer('from_country');
			$table->integer('from_state');
			$table->integer('to_country');
			$table->integer('to_state');
			$table->double('member_discount', 5, 2);
			$table->double('member_discount_amt', 12, 2);
			$table->string('other_discount_type')->nullable();
			$table->double('other_discount', 5, 2);
			$table->double('other_discount_amt', 12, 2);
			$table->double('gov_tax', 5, 2);
			$table->double('gov_tax_amt', 12, 2);
			$table->double('service_charge', 5, 2);
			$table->double('service_charge_amt', 12, 2);
			$table->double('total_amt', 12, 2);
			$table->double('net_amt', 12, 2);
			$table->enum('payment', ['Paid', 'Credit']);
			$table->integer('total_items');
			$table->text('remarks')->nullable();
			// $table->enum('status', [0, 1, 2, 3, 4]);
			$table->enum('status', [0, 1, 2, 3]);
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
		Schema::drop('lotins');
	}
}
