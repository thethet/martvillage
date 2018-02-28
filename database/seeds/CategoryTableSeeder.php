<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$currencies = [
			[
				'company_id' => 1,
				'name'       => 'Weight',
				'unit'       => 'kg',
				'deleted'    => 'N',
				'created_by' => 1,
				'updated_by' => 1,
			],
			[
				'company_id' => 1,
				'name'       => 'Size',
				'unit'       => 'ft3',
				'deleted'    => 'N',
				'created_by' => 1,
				'updated_by' => 1,
			],
			[
				'company_id' => 1,
				'name'       => 'Insurance',
				'unit'       => '%',
				'deleted'    => 'N',
				'created_by' => 1,
				'updated_by' => 1,
			],
			[
				'company_id' => 1,
				'name'       => 'Document',
				'unit'       => 'docs',
				'deleted'    => 'N',
				'created_by' => 1,
				'updated_by' => 1,
			],
			[
				'company_id' => 1,
				'name'       => 'Quantity',
				'unit'       => 'pcs',
				'deleted'    => 'N',
				'created_by' => 1,
				'updated_by' => 1,
			],
		];

		foreach ($currencies as $key => $value) {
			Category::create($value);
		}
	}
}
