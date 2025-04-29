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
		Schema::create('cleaning', function (Blueprint $table) {
			$table->id();
			$table->integer('company_id')->nullable();
			$table->string('ref_no')->nullable();
			$table->integer('tank_type_id')->default(0);
			$table->string('tank_no')->nullable();
			$table->integer('tcode_id')->nullable();
			$table->integer('customer_id')->default(0);
			$table->string('csc')->nullable();
			$table->string('mfgt_date')->nullable();
			$table->string('last_inspection_date')->nullable();
			$table->integer('mgw')->nullable();
			$table->string('next_date')->nullable();
			$table->integer('capacity')->nullable();
			$table->string('tare_wt')->nullable();
			$table->integer('inspection_locn')->default(0);
			$table->date('inspection_date')->nullable();
			$table->integer('client_id')->default(0);
			$table->integer('cleaning_location_id')->default(0);
			// $table->string('ref')->nullable();
			$table->string('last_cargo_carried')->nullable();
			$table->integer('surveyor_id')->default(0);

			$table->integer('frame_tank')->nullable();
			$table->integer('manlid_valves')->nullable();
			$table->integer('serial_nos')->nullable();
			$table->integer('labels_removed')->nullable();
			$table->integer('entry')->nullable();
			$table->integer('odour_free')->nullable();
			$table->integer('clean_free')->nullable();
			$table->integer('corrosion_free')->nullable();
			$table->integer('dry')->nullable();
			$table->integer('valves')->nullable();
			$table->integer('manlid_seal')->nullable();
			$table->integer('gas_free')->nullable();
			$table->integer('siphon')->nullable();
			$table->mediumtext('remarks')->nullable();
			$table->mediumtext('interior')->nullable();
			$table->mediumtext('exterior')->nullable();
			$table->mediumtext('sealno')->nullable();
			$table->boolean('status')->default(true);
			$table->integer("created_by")->default(1);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('cleaning');
	}
};
