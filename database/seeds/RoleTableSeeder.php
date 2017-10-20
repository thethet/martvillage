<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$roles = [
			[
				'company_id'   => 1,
				'name'         => 'administrator',
				'display_name' => 'Project Administrator',
				'description'  => 'Administrator allow to manage whole project',
			],

			[
				'company_id'   => 1,
				'name'         => 'owner',
				'display_name' => 'CEO',
				'description'  => 'Owner allow to manage his/her own resources',
			],

			/*[
		'company_id'         => 1,
		'name'         => 'manager',
		'display_name' => 'Manager',
		'description'  => 'Manager can access only permission that set from Owner',
		],

		[
		'company_id'         => 1,
		'name'         => 'staff',
		'display_name' => 'Staff',
		'description'  => 'Staff can access only permission that set from Owner',
		],*/
		];

		foreach ($roles as $key => $value) {
			$roleUser = Role::create($value);
		}
		$role = Role::find(1);
		$user = User::where('username', '=', 'thetthet')->first();
		$user->attachRole($role);

	}
}
