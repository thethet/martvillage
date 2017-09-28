<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblOutgoings extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('outgoings', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('lotin_id')->default(0);
			$table->integer('item_id')->default(0);
			$table->string('passenger_name');
			$table->string('carrier_name');
			$table->string('contact_no');
			$table->string('shipping_line')->nullable();
			$table->string('vessel_no')->nullable();
			$table->date('dep_date');
			$table->time('time');
			$table->string('weight');
			$table->string('other_weight')->nullable()->nullable();
			$table->integer('box')->nullable();
			$table->integer('from_country')->default(0);
			$table->integer('from_city')->default(0);
			$table->integer('to_country')->default(0);
			$table->integer('to_city')->default(0);
			$table->string('packing_list')->default(0);
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
		Schema::drop('outgoings');
	}
}
