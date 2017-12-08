<?php

use App\Permission;
use App\Role;
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
				'name'         => 'category-list',
				'display_name' => 'Display Category Listing',
				'description'  => 'See only Listing Of Category',
			],
			[
				'name'         => 'category-create',
				'display_name' => 'Create Category',
				'description'  => 'Create New Category',
			],
			[
				'name'         => 'category-edit',
				'display_name' => 'Edit Category',
				'description'  => 'Edit Category',
			],
			[
				'name'         => 'category-delete',
				'display_name' => 'Delete Category',
				'description'  => 'Delete Category',
			],

			[
				'name'         => 'currency-list',
				'display_name' => 'Display Currency Listing',
				'description'  => 'See only Listing Of Currency',
			],
			[
				'name'         => 'currency-create',
				'display_name' => 'Create Currency',
				'description'  => 'Create New Currency',
			],
			[
				'name'         => 'currency-edit',
				'display_name' => 'Edit Currency',
				'description'  => 'Edit Currency',
			],
			[
				'name'         => 'currency-delete',
				'display_name' => 'Delete Currency',
				'description'  => 'Delete Currency',
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

			[
				'name'         => 'member-offer-list',
				'display_name' => 'Display Member Offer Listing',
				'description'  => 'See only Listing Of Member Offer',
			],
			[
				'name'         => 'member-offer-create',
				'display_name' => 'Create Member Offer',
				'description'  => 'Create Member Offer',
			],
			[
				'name'         => 'member-offer-edit',
				'display_name' => 'Edit Member Offer',
				'description'  => 'Edit Member Offer',
			],
			[
				'name'         => 'member-offer-delete',
				'display_name' => 'Delete Member Offer',
				'description'  => 'Delete Member Offer',
			],

			[
				'name'         => 'member-list',
				'display_name' => 'Display Member Listing',
				'description'  => 'See only Listing Of Member',
			],
			[
				'name'         => 'member-create',
				'display_name' => 'Create Member',
				'description'  => 'Create New Member',
			],
			[
				'name'         => 'member-edit',
				'display_name' => 'Edit Member',
				'description'  => 'Edit Member',
			],
			[
				'name'         => 'member-delete',
				'display_name' => 'Delete Member',
				'description'  => 'Delete Member',
			],

			[
				'name'         => 'lotin-list',
				'display_name' => 'Display Lot-in Listing',
				'description'  => 'See only Listing Of Lot-in',
			],
			[
				'name'         => 'lotin-create',
				'display_name' => 'Create Lot-in',
				'description'  => 'Create New Lot-in',
			],
			[
				'name'         => 'lotin-edit',
				'display_name' => 'Edit Lot-in',
				'description'  => 'Edit Lot-in',
			],
			[
				'name'         => 'lotin-delete',
				'display_name' => 'Delete Lot-in',
				'description'  => 'Delete Lot-in',
			],

			[
				'name'         => 'outgoing-list',
				'display_name' => 'Display Outgoing Listing',
				'description'  => 'See only Listing Of Outgoing',
			],
			[
				'name'         => 'outgoing-create',
				'display_name' => 'Create Outgoing',
				'description'  => 'Create New Outgoing',
			],
			[
				'name'         => 'outgoing-edit',
				'display_name' => 'Edit Outgoing',
				'description'  => 'Edit Outgoing',
			],
			[
				'name'         => 'outgoing-delete',
				'display_name' => 'Delete Outgoing',
				'description'  => 'Delete Outgoing',
			],

			[
				'name'         => 'tracking-list',
				'display_name' => 'Display Tracking Listing',
				'description'  => 'See only Listing Of Tracking',
			],
			[
				'name'         => 'tracking-create',
				'display_name' => 'Create Tracking',
				'description'  => 'Create New Tracking',
			],
			[
				'name'         => 'tracking-edit',
				'display_name' => 'Edit Tracking',
				'description'  => 'Edit Tracking',
			],
			[
				'name'         => 'tracking-delete',
				'display_name' => 'Delete Tracking',
				'description'  => 'Delete Tracking',
			],
			[
				'name'         => 'tracking-show',
				'display_name' => 'Show Tracking Detail',
				'description'  => 'Show Tracking Detail',
			],

			[
				'name'         => 'collection-list',
				'display_name' => 'Display Collection Listing',
				'description'  => 'See only Listing Of Collection',
			],
			[
				'name'         => 'collection-create',
				'display_name' => 'Create Collection',
				'description'  => 'Create New Collection',
			],
			[
				'name'         => 'collection-edit',
				'display_name' => 'Edit Collection',
				'description'  => 'Edit Collection',
			],
			[
				'name'         => 'collection-delete',
				'display_name' => 'Delete Collection',
				'description'  => 'Delete Collection',
			],

			[
				'name'         => 'lotbalance-list',
				'display_name' => 'Display Lot Balance Listing',
				'description'  => 'See only Listing Of Lot Balance',
			],
			[
				'name'         => 'lotbalance-create',
				'display_name' => 'Create Lot Balance',
				'description'  => 'Create New Lot Balance',
			],
			[
				'name'         => 'lotbalance-edit',
				'display_name' => 'Edit Lot Balance',
				'description'  => 'Edit Lot Balance',
			],
			[
				'name'         => 'lotbalance-delete',
				'display_name' => 'Delete Lot Balance',
				'description'  => 'Delete Lot Balance',
			],

			[
				'name'         => 'message-list',
				'display_name' => 'Display Message Listing',
				'description'  => 'See only Listing Of Message',
			],
			[
				'name'         => 'message-create',
				'display_name' => 'Create Message',
				'description'  => 'Create New Message',
			],
			[
				'name'         => 'message-edit',
				'display_name' => 'Edit Message',
				'description'  => 'Edit Message',
			],
			[
				'name'         => 'message-delete',
				'display_name' => 'Delete Message',
				'description'  => 'Delete Message',
			],

			[
				'name'         => 'report-list',
				'display_name' => 'Display Report Listing',
				'description'  => 'See only Listing Of Report',
			],
			[
				'name'         => 'report-create',
				'display_name' => 'Create Report',
				'description'  => 'Create New Report',
			],
			[
				'name'         => 'report-edit',
				'display_name' => 'Edit Report',
				'description'  => 'Edit Report',
			],
			[
				'name'         => 'report-delete',
				'display_name' => 'Delete Report',
				'description'  => 'Delete Report',
			],

			[
				'name'         => 'incoming-list',
				'display_name' => 'Display Incoming Listing',
				'description'  => 'See only Listing Of Incoming',
			],
			[
				'name'         => 'incoming-create',
				'display_name' => 'Create Incoming',
				'description'  => 'Create New Incoming',
			],
			[
				'name'         => 'incoming-edit',
				'display_name' => 'Edit Incoming',
				'description'  => 'Edit Incoming',
			],
			[
				'name'         => 'incoming-delete',
				'display_name' => 'Delete Incoming',
				'description'  => 'Delete Incoming',
			],
		];

		$role1 = Role::find(1);
		$role2 = Role::find(2);
		// $admin->detachAllPermissions();
		foreach ($permission as $key => $value) {
			$permiss = Permission::create($value);
			// $role    = Role::where('id', '=', 1)->first();
			$role1->attachPermission($permiss->id);
			$role2->attachPermission($permiss->id);
		}
	}
}
