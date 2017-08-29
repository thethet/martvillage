<?php

use App\NricCodes;
use Illuminate\Database\Seeder;

class NricCodesTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$codes = [
			[
				'nric_code'   => 1,
				'description' => 'Kachin State (ကခ်င္)',
				'deleted'     => 'N',
				'created_by'  => 1,
				'updated_by'  => 1,
			],

			[
				'nric_code'   => 2,
				'description' => 'Kayah State (ကယား)',
				'deleted'     => 'N',
				'created_by'  => 1,
				'updated_by'  => 1,
			],

			[
				'nric_code'   => 3,
				'description' => 'Kayin State (ကရင္)',
				'deleted'     => 'N',
				'created_by'  => 1,
				'updated_by'  => 1,
			],

			[
				'nric_code'   => 4,
				'description' => 'Chin State (ခ်င္း)',
				'deleted'     => 'N',
				'created_by'  => 1,
				'updated_by'  => 1,
			],

			[
				'nric_code'   => 5,
				'description' => 'Sagaing Division (စစ္ကိုင္း)',
				'deleted'     => 'N',
				'created_by'  => 1,
				'updated_by'  => 1,
			],

			[
				'nric_code'   => 6,
				'description' => 'Tanintharyi Division (တနသၤာရီ)',
				'deleted'     => 'N',
				'created_by'  => 1,
				'updated_by'  => 1,
			],

			[
				'nric_code'   => 7,
				'description' => 'Bago Division (ပဲခူး)',
				'deleted'     => 'N',
				'created_by'  => 1,
				'updated_by'  => 1,
			],

			[
				'nric_code'   => 8,
				'description' => 'Magway Division (မေကြး)',
				'deleted'     => 'N',
				'created_by'  => 1,
				'updated_by'  => 1,
			],

			[
				'nric_code'   => 9,
				'description' => 'Mandalay Division (မႏၲေလး)',
				'deleted'     => 'N',
				'created_by'  => 1,
				'updated_by'  => 1,
			],

			[
				'nric_code'   => 10,
				'description' => 'Mon State (မြန္)',
				'deleted'     => 'N',
				'created_by'  => 1,
				'updated_by'  => 1,
			],

			[
				'nric_code'   => 11,
				'description' => 'Rakhine State (ရခိုင္)',
				'deleted'     => 'N',
				'created_by'  => 1,
				'updated_by'  => 1,
			],

			[
				'nric_code'   => 12,
				'description' => 'Yangon Division (ရန္ကုန္)',
				'deleted'     => 'N',
				'created_by'  => 1,
				'updated_by'  => 1,
			],

			[
				'nric_code'   => 13,
				'description' => 'Shan State (ရွမ္း)',
				'deleted'     => 'N',
				'created_by'  => 1,
				'updated_by'  => 1,
			],

			[
				'nric_code'   => 14,
				'description' => 'Ayeyarwady Division (ဧရာ၀တီ)',
				'deleted'     => 'N',
				'created_by'  => 1,
				'updated_by'  => 1,
			],

			[
				'nric_code'   => 15,
				'description' => 'Naypyitaw (ေနျပည္ေတာ္)',
				'deleted'     => 'N',
				'created_by'  => 1,
				'updated_by'  => 1,
			],

			[
				'nric_code'   => 16,
				'description' => 'Other (အျခား)',
				'deleted'     => 'N',
				'created_by'  => 1,
				'updated_by'  => 1,
			],
		];

		foreach ($codes as $key => $value) {
			NricCodes::create($value);
		}
	}
}
