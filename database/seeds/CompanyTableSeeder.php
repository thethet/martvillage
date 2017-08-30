<?php

use App\Companies;
use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$company = [
			[
				'company_name'  => 'TTA',
				'contact_no'    => '',
				'fax'           => '',
				'email'         => 'thetthetaye2709@gmail.com',
				'logo'          => '',
				'unit_number'   => '',
				'building_name' => '',
				'street'        => '',
				'country_id'    => 0,
				'state_id'      => 0,
				'township_id'   => 0,
				'address'       => '',
				'location'      => '',
				'expiry_date'   => date('Y-m-d'),
				'deleted'       => 'N',
				'created_by'    => 1,
				'updated_by'    => 1,
			],
		];

		foreach ($company as $key => $value) {
			Companies::create($value);
		}
	}
}
