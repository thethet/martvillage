<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$roles = [
			[
				'name'         => 'administrator',
				'display_name' => 'Project Administrator',
				'description'  => 'Administrator allow to manage whole project',
			],

			/*[
		'name'         => 'owner',
		'display_name' => 'Company Owner',
		'description'  => 'Owner allow to manage his/her own resources',
		],

		[
		'name'         => 'manager',
		'display_name' => 'Manager',
		'description'  => 'Manager can access only permission that set from Owner',
		],

		[
		'name'         => 'staff',
		'display_name' => 'Staff',
		'description'  => 'Staff can access only permission that set from Owner',
		],*/
		];

		foreach ($roles as $key => $value) {
			$roleUser = Role::create($value);
			$user     = User::where('username', '=', 'thetthet')->first();
			$user->attachRole($roleUser);
		}

	}
}
