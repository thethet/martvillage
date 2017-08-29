<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$permission = [
			[
				'name'         => 'role-list',
				'display_name' => 'Display Role Listing',
				'description'  => 'See only Listing Of Role',
			],
			[
				'name'         => 'role-create',
				'display_name' => 'Create Role',
				'description'  => 'Create New Role',
			],
			[
				'name'         => 'role-edit',
				'display_name' => 'Edit Role',
				'description'  => 'Edit Role',
			],
			[
				'name'         => 'role-delete',
				'display_name' => 'Delete Role',
				'description'  => 'Delete Role',
			],

			[
				'name'         => 'permission-list',
				'display_name' => 'Display Permission Listing',
				'description'  => 'See only Listing Of Permission',
			],
			[
				'name'         => 'permission-create',
				'display_name' => 'Create Permission',
				'description'  => 'Create New Permission',
			],
			[
				'name'         => 'permission-edit',
				'display_name' => 'Edit Permission',
				'description'  => 'Edit Permission',
			],
			[
				'name'         => 'permission-delete',
				'display_name' => 'Delete Permission',
				'description'  => 'Delete Permission',
			],

			[
				'name'         => 'company-list',
				'display_name' => 'Display Company Listing',
				'description'  => 'See only Listing Of Company',
			],
			[
				'name'         => 'company-create',
				'display_name' => 'Create Company',
				'description'  => 'Create New Company',
			],
			[
				'name'         => 'company-edit',
				'display_name' => 'Edit Company',
				'description'  => 'Edit Company',
			],
			[
				'name'         => 'company-delete',
				'display_name' => 'Delete Company',
				'description'  => 'Delete Company',
			],

			[
				'name'         => 'user-list',
				'display_name' => 'Display User Listing',
				'description'  => 'See only Listing Of User',
			],
			[
				'name'         => 'user-create',
				'display_name' => 'Create User',
				'description'  => 'Create New User',
			],
			[
				'name'         => 'user-edit',
				'display_name' => 'Edit User',
				'description'  => 'Edit User',
			],
			[
				'name'         => 'user-delete',
				'display_name' => 'Delete User',
				'description'  => 'Delete User',
			],

			[
				'name'         => 'nric-code-list',
				'display_name' => 'Display NRIC Code Listing',
				'description'  => 'See only Listing Of NRIC Code',
			],
			[
				'name'         => 'nric-code-create',
				'display_name' => 'Create NRIC Code',
				'description'  => 'Create New NRIC Code',
			],
			[
				'name'         => 'nric-code-edit',
				'display_name' => 'Edit NRIC Code',
				'description'  => 'Edit NRIC Code',
			],
			[
				'name'         => 'nric-code-delete',
				'display_name' => 'Delete NRIC Code',
				'description'  => 'Delete NRIC Code',
			],

			[
				'name'         => 'nric-township-list',
				'display_name' => 'Display NRIC Township Listing',
				'description'  => 'See only Listing Of NRIC Township',
			],
			[
				'name'         => 'nric-township-create',
				'display_name' => 'Create NRIC Township',
				'description'  => 'Create New NRIC Township',
			],
			[
				'name'         => 'nric-township-edit',
				'display_name' => 'Edit NRIC Township',
				'description'  => 'Edit NRIC Township',
			],
			[
				'name'         => 'nric-township-delete',
				'display_name' => 'Delete NRIC Township',
				'description'  => 'Delete NRIC Township',
			],

			[
				'name'         => 'nationality-list',
				'display_name' => 'Display Nationality Listing',
				'description'  => 'See only Listing Of Nationality',
			],
			[
				'name'         => 'nationality-create',
				'display_name' => 'Create Nationality',
				'description'  => 'Create New Nationality',
			],
			[
				'name'         => 'nationality-edit',
				'display_name' => 'Edit Nationality',
				'description'  => 'Edit Nationality',
			],
			[
				'name'         => 'nationality-delete',
				'display_name' => 'Delete Nationality',
				'description'  => 'Delete Nationality',
			],

			[
				'name'         => 'country-list',
				'display_name' => 'Display Country Listing',
				'description'  => 'See only Listing Of Country',
			],
			[
				'name'         => 'country-create',
				'display_name' => 'Create Country',
				'description'  => 'Create New Country',
			],
			[
				'name'         => 'country-edit',
				'display_name' => 'Edit Country',
				'description'  => 'Edit Country',
			],
			[
				'name'         => 'country-delete',
				'display_name' => 'Delete Country',
				'description'  => 'Delete Country',
			],

			[
				'name'         => 'state-list',
				'display_name' => 'Display State Listing',
				'description'  => 'See only Listing Of State',
			],
			[
				'name'         => 'state-create',
				'display_name' => 'Create State',
				'description'  => 'Create New State',
			],
			[
				'name'         => 'state-edit',
				'display_name' => 'Edit State',
				'description'  => 'Edit State',
			],
			[
				'name'         => 'state-delete',
				'display_name' => 'Delete State',
				'description'  => 'Delete State',
			],

			[
				'name'         => 'township-list',
				'display_name' => 'Display Township Listing',
				'description'  => 'See only Listing Of Township',
			],
			[
				'name'         => 'township-create',
				'display_name' => 'Create Township',
				'description'  => 'Create New Township',
			],
			[
				'name'         => 'township-edit',
				'display_name' => 'Edit Township',
				'description'  => 'Edit Township',
			],
			[
				'name'         => 'township-delete',
				'display_name' => 'Delete Township',
				'description'  => 'Delete Township',
			],

			[
				'name'         => 'price-list',
				'display_name' => 'Display Price Listing',
				'description'  => 'See only Listing Of Price',
			],
			[
				'name'         => 'price-create',
				'display_name' => 'Create Price',
				'description'  => 'Create New Price',
			],
			[
				'name'         => 'price-edit',
				'display_name' => 'Edit Price',
				'description'  => 'Edit Price',
			],
			[
				'name'         => 'price-delete',
				'display_name' => 'Delete Price',
				'description'  => 'Delete Price',
			],
		];

		foreach ($permission as $key => $value) {
			Permission::create($value);
		}
	}
}
