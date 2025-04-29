<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		// \App\Models\User::factory(10)->create();

		// \App\Models\User::factory()->create([
		//     'name' => 'Test User',
		//     'email' => 'test@example.com',
		// ]);

		\App\Models\User::factory()->create([
			'name' => 'Administrator', 'email' => 'admin@seamarine.co', 'password' => Hash::make('seamarine123'),
			'date_of_joining' => '2014-03-11',
			'department_id' => 1, 
			'employee_code' => 'SM001', 'hierarchy_node_id' => '1.', 'role_id' => 1,
			'status' => true, 'created_by' => 1,
			'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")
		]);

		// boss 1
		\App\Models\User::factory()->create([
			'name' => 'Prashant', 'email' => 'prashant@seamarine.co', 'password' => Hash::make('seamarine123'),
			'date_of_joining' => '2014-03-11',
			'department_id' => 1, 
			'employee_code' => 'SM002', 'hierarchy_node_id' => '1.2.', 'role_id' => 2,
			'status' => true, 'created_by' => 1,
			'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")
		]);

		// Employee 1
		\App\Models\User::factory()->create([
			'name' => 'Ganesh', 'email' => 'ganesh@seamarine.co', 'password' => Hash::make('seamarine123'),
			'date_of_joining' => '2014-03-11',
			'department_id' => 1, 
			'employee_code' => 'SM003', 'hierarchy_node_id' => '1.2.3.', 'role_id' => 2,
			'status' => true, 'created_by' => 1,
			'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")
		]);
		// Employee 2
		\App\Models\User::factory()->create([
			'name' => 'Amit', 'email' => 'amit@seamarine.co', 'password' => Hash::make('seamarine123'),
			'date_of_joining' => '2014-03-11',
			'department_id' => 1, 
			'employee_code' => 'SM004', 'hierarchy_node_id' => '1.2.4.', 'role_id' => 2,
			'status' => true, 'created_by' => 1,
			'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")
		]);

		\App\Models\Department::create([ 'title' => 'Other', 'created_by' => 1, ]);

		\App\Models\Role::create([ 'title' => 'Administrator', 'created_by' => 1, ]);
		\App\Models\Role::create([ 'title' => 'Customer', 'created_by' => 1, ]);
		\App\Models\Role::create([ 'title' => 'Employee', 'created_by' => 1, ]);
		\App\Models\Role::create([ 'title' => 'Surveyor', 'created_by' => 1, ]);

		// --------------------------------------------------
		// Masters
		\App\Models\PlatformObject::create([
			'title' => 'Role', 'name' => 'Role', 'url' => '/role/',
			'phicon' => 'eyeglasses',
			'hierarchical' => false, 'for_admin_only' => true,
			'category' => 13, 'created_by' => 1,
		]);
		
		\App\Models\PlatformObject::create([
			'title' => 'Platform Objects', 'name' => 'PlatformObject', 'url' => '/platformobject/',
			'phicon' => 'article',
			'hierarchical' => false, 'for_admin_only' => true,
			'category' => 13, 'created_by' => 1,
		]);

		// --------------------------------------------------
		\App\Models\PlatformObject::create([
			'title' => 'Company', 'name' => 'Company', 'url' => '/company/',
			'phicon' => 'map-pin',
			'hierarchical' => false, 'for_admin_only' => false,
			'category' => 11, 'created_by' => 1,
		]);
		\App\Models\PlatformObject::create([
			'title' => 'Department', 'name' => 'Department', 'url' => '/department/',
			'phicon' => 'user-rectangle',
			'hierarchical' => false, 'for_admin_only' => false,
			'category' => 11, 'created_by' => 1,
		]);
		\App\Models\PlatformObject::create([
			'title' => 'Country', 'name' => 'Country', 'url' => '/country/',
			'phicon' => 'map-pin',
			'hierarchical' => false, 'for_admin_only' => false,
			'category' => 11, 'created_by' => 1,
		]);
		\App\Models\PlatformObject::create([
			'title' => 'Cleaning Location', 'name' => 'CleaningLocation', 'url' => '/cleaninglocation/',
			'phicon' => 'map-pin',
			'hierarchical' => false, 'for_admin_only' => false,
			'category' => 11, 'created_by' => 1,
		]);
		\App\Models\PlatformObject::create([
			'title' => 'Inspection Location', 'name' => 'InspectionLocation', 'url' => '/inspectionlocation/',
			'phicon' => 'map-pin',
			'hierarchical' => false, 'for_admin_only' => false,
			'category' => 11, 'created_by' => 1,
		]);
		\App\Models\PlatformObject::create([
			'title' => 'IMO Condition Status', 'name' => 'IMOConditionStatus', 'url' => '/imoconditionstatus/',
			'phicon' => 'map-pin',
			'hierarchical' => false, 'for_admin_only' => false,
			'category' => 11, 'created_by' => 1,
		]);
		\App\Models\PlatformObject::create([
			'title' => 'Tank Type', 'name' => 'TankType', 'url' => '/tanktype/',
			'phicon' => 'rectangle',
			'hierarchical' => false, 'for_admin_only' => false,
			'category' => 11, 'created_by' => 1,
		]);
		\App\Models\PlatformObject::create([
			'title' => 'TCode', 'name' => 'TCode', 'url' => '/tcode/',
			'phicon' => 'brackets-angle',
			'hierarchical' => false, 'for_admin_only' => false,
			'category' => 11, 'created_by' => 1,
		]);
		\App\Models\PlatformObject::create([
			'title' => 'Surveyor', 'name' => 'Surveyor', 'url' => '/surveyor/',
			'phicon' => 'user',
			'hierarchical' => false, 'for_admin_only' => false,
			'category' => 11, 'created_by' => 1,
		]);

		\App\Models\PlatformObject::create([
			'title' => 'Customer', 'name' => 'Customer', 'url' => '/customer/',
			'phicon' => 'user',
			'hierarchical' => false, 'for_admin_only' => false,
			'category' => 11, 'created_by' => 1,
		]);
		\App\Models\PlatformObject::create([
			'title' => 'Cleaning', 'name' => 'Cleaning', 'url' => '/cleaning/',
			'phicon' => 'gear',
			'hierarchical' => false, 'for_admin_only' => false,
			'category' => 12, 'created_by' => 1,
		]);
		\App\Models\PlatformObject::create([
			'title' => 'Drybox', 'name' => 'Drybox', 'url' => '/drybox/',
			'phicon' => 'rectangle',
			'hierarchical' => false, 'for_admin_only' => false,
			'category' => 12, 'created_by' => 1,
		]);
		\App\Models\PlatformObject::create([
			'title' => 'IMO1 Condition', 'name' => 'IMO1', 'url' => '/imo1/',
			'phicon' => 'rectangle',
			'hierarchical' => false, 'for_admin_only' => false,
			'category' => 12, 'created_by' => 1,
		]);
		\App\Models\PlatformObject::create([
			'title' => 'IMO5 Condition', 'name' => 'IMO5', 'url' => '/imo5condition/',
			'phicon' => 'rectangle',
			'hierarchical' => false, 'for_admin_only' => false,
			'category' => 12, 'created_by' => 1,
		]);
		\App\Models\PlatformObject::create([
			'title' => 'Shipper Survey', 'name' => 'ShipperSurvey', 'url' => '/shippersurvey/',
			'phicon' => 'rectangle',
			'hierarchical' => false, 'for_admin_only' => false,
			'category' => 12, 'created_by' => 1,
		]);
		\App\Models\PlatformObject::create([
			'title' => 'Weightment', 'name' => 'Weightment', 'url' => '/weightment/',
			'phicon' => 'rectangle',
			'hierarchical' => false, 'for_admin_only' => false,
			'category' => 12, 'created_by' => 1,
		]);
		\App\Models\PlatformObject::create([
			'title' => 'OnHire', 'name' => 'On Hire', 'url' => '/onhire/',
			'phicon' => 'rectangle',
			'hierarchical' => false, 'for_admin_only' => false,
			'category' => 12, 'created_by' => 1,
		]);
		// --------------------------------------------------

		DB::table('role_object_mapping')->insert([
			'role_id' => 1,
			'platform_object_id' => 1,
			'can_add_edit' => true, 'can_delete' => true
		]);
		DB::table('role_object_mapping')->insert([
			'role_id' => 1,
			'platform_object_id' => 2,
			'can_add_edit' => true, 'can_delete' => true
		]);
		// --------------------------------------------------

		\App\Models\Country::create([ 'name' => 'India' ]);
		\App\Models\Country::create([ 'name' => 'UAE' ]);
		\App\Models\Country::create([ 'name' => 'Saudi Arabia' ]);
		// --------------------------------------------------

		\App\Models\TankType::create([ 'type' => 'IMO 1' ]);
		\App\Models\TankType::create([ 'type' => 'IMO 5' ]);
		// --------------------------------------------------

		\App\Models\Tcode::create([ 'name' => 'T1' ]);
		\App\Models\Tcode::create([ 'name' => 'T2' ]);
		\App\Models\Tcode::create([ 'name' => 'T3' ]);
		\App\Models\Tcode::create([ 'name' => 'T4' ]);
		\App\Models\Tcode::create([ 'name' => 'T5' ]);
		// --------------------------------------------------

		\App\Models\Surveyor::create([ 'name' => 'Maruti Patil', 'mobile_number' => '9320341591' ]);
		\App\Models\Surveyor::create([ 'name' => 'Vijay Patil', 'mobile_number' => '9833448572' ]);
		\App\Models\Surveyor::create([ 'name' => 'Gulab Nirmal', 'mobile_number' => '9320341595' ]);
		\App\Models\Surveyor::create([ 'name' => 'Jayant Thakur', 'mobile_number' => '9773043747' ]);
		// --------------------------------------------------

		\App\Models\ImoConditionStatus::create([ 'title' => 'OK', 'code' => 'OK' ]);
		\App\Models\ImoConditionStatus::create([ 'title' => 'NOT FITTED', 'code' => 'NF' ]);
		\App\Models\ImoConditionStatus::create([ 'title' => 'CUT/CRACKED', 'code' => 'C' ]);
		\App\Models\ImoConditionStatus::create([ 'title' => 'BENT', 'code' => 'B' ]);
		\App\Models\ImoConditionStatus::create([ 'title' => 'MISSING', 'code' => 'M' ]);
		\App\Models\ImoConditionStatus::create([ 'title' => 'DENTED', 'code' => 'D' ]);
		\App\Models\ImoConditionStatus::create([ 'title' => 'LOOSE', 'code' => 'L' ]);
		\App\Models\ImoConditionStatus::create([ 'title' => 'HOLE', 'code' => 'H' ]);
		\App\Models\ImoConditionStatus::create([ 'title' => 'BROKEN', 'code' => 'BR' ]);
		\App\Models\ImoConditionStatus::create([ 'title' => 'CLAIM', 'code' => 'CL' ]);
		\App\Models\ImoConditionStatus::create([ 'title' => 'N/A', 'code' => 'NA' ]);
		// --------------------------------------------------

		\App\Models\CleaningLocation::create([ 'name' => 'SAI PRABHA MARINE YARD' ]);
		\App\Models\CleaningLocation::create([ 'name' => 'Oceanglobe Containers, Taloja' ]);
		\App\Models\CleaningLocation::create([ 'name' => 'Silver Global Services Pvt. Ltd.' ]);
		\App\Models\CleaningLocation::create([ 'name' => 'RUCON MARINE CONTAINERS' ]);
		\App\Models\CleaningLocation::create([ 'name' => 'EFC YARD' ]);
		// --------------------------------------------------

		\App\Models\InspectionLocation::create([ 'name' => 'Oceanglobe Yard', 'country_id' => 1 ]);
		\App\Models\InspectionLocation::create([ 'name' => 'RUCON, YARD', 'country_id' => 1 ]);
		\App\Models\InspectionLocation::create([ 'name' => 'GDL CFS', 'country_id' => 1 ]);
		\App\Models\InspectionLocation::create([ 'name' => 'Sea Bird CFS', 'country_id' => 1 ]);
		\App\Models\InspectionLocation::create([ 'name' => 'Speedy CFS', 'country_id' => 1 ]);
		// --------------------------------------------------
	}
}
