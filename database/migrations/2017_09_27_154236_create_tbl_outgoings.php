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
			$table->integer('company_id');
			$table->integer('lotin_id')->default(0);
			$table->string('passenger_name');
			$table->string('carrier_name');
			$table->string('contact_no');
			$table->string('shipping_line')->nullable();
			$table->string('vessel_no')->nullable();
			$table->date('dept_date');
			$table->time('dept_time');
			$table->date('arrival_date');
			$table->time('arrival_time');
			$table->string('weight');
			$table->string('other_weight')->default(0);
			$table->integer('box')->default(0);
			$table->integer('from_country')->default(0);
			$table->integer('from_city')->default(0);
			$table->integer('to_country')->default(0);
			$table->integer('to_city')->default(0);
			$table->integer('packing_list')->default(0);
			$table->string('packing_id_list')->nullable();
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
