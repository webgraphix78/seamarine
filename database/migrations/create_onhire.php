<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('onhire', function (Blueprint $table) {
			$table->id();
			$table->integer('company_id');
			$table->string('ref_no')->nullable();
			$table->integer('customer_id');
			$table->integer('survey_type')->comment('1=On-Hire,2=Off-hire,3=Condition');
			$table->string('inspection_date')->nullable();
			$table->integer('inspection_location_id')->default(0);
			$table->integer('form_liquid_tanks')->comment('1=Food,2=Chemicals')->default(0);
			$table->integer('surveyor_id')->default(0);
			$table->string('unit_nr')->nullable();
			$table->integer('tank_type_id')->default(0);
			$table->integer('tcode_id')->default(0);
			$table->string('manufacturer')->nullable();
			$table->string('iso_type')->nullable();
			$table->string('adr')->nullable();
			$table->string('serial_no')->nullable();
			$table->string('first_test')->nullable();
			$table->string('first_by')->nullable();
			$table->string('last_25')->nullable();
			$table->string('last_25_by')->nullable();
			$table->string('last_5')->nullable();
			$table->string('last_5_by')->nullable();
			$table->string('next_due_date')->nullable();
			$table->string('csc_acep_date')->nullable();
			$table->integer('max_gross_wgt')->default(0);
			$table->integer('tare_wgt')->default(0);
			$table->integer('capacity')->default(0);
			$table->string('mawp')->nullable();
			$table->string('test_pressure')->nullable();
			$table->string('steam_tube_wp')->nullable();
			$table->string('steam_test_pressure')->nullable();
			$table->string('shell_tank_material')->nullable();
			$table->string('shell_head')->nullable();
			$table->string('shell_thickness')->nullable();
			$table->string('shell_head_thickness')->nullable();
			$table->integer('onhire_main_id')->default(0);
			$table->integer('onhire_ancillary_id')->default(0);
			$table->integer('onhire_unitnr_id')->default(0);
			$table->string('walkway_image_1')->nullable();
			$table->string('walkway_image_2')->nullable();
			$table->text('comment_1')->nullable();
			$table->text('comment_2')->nullable();
			$table->boolean('status')->default(true);
			$table->integer('created_by')->default(1);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('onhire');
	}
};
