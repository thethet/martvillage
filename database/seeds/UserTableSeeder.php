<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$users = [
			[
				'company_id'       => 1,
				'name'             => 'Thet Thet Aye',
				'nric_no'          => '9/၀တန(N)၁၄၀၀၀၇',
				'nric_code_id'     => 9,
				'nric_township_id' => 0,
				'marital_status'   => 'Single',
				'contact_no'       => '',
				'position'         => 'Web Developer',
				'nationality'      => 0,
				'email'            => 'thetthetaye2709@gmail.com',
				'username'         => 'thetthet',
				'password'         => bcrypt('thetthet'),
				'unit_number'      => '#08-858',
				'building_name'    => 'Blk 840',
				'street'           => 'Sims Ave',
				'country_id'       => 0,
				'state_id'         => 0,
				'township_id'      => 0,
				'address'          => 'Blk 840, #08-858, Sims Ave, Singapore 400840',
				'photo'            => '',
				'deleted'          => 'N',
				'created_by'       => 1,
				'updated_by'       => 1,
			],
		];

		foreach ($users as $key => $value) {
			User::create($value);
		}
	}
}
