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
        Schema::create('imo5_condition', function (Blueprint $table) {
            $table->id();
			$table->string("container_no")->nullable();
			$table->integer("tank_type_id")->default(0);
			$table->integer("tcode_id")->default(0);
			$table->string("client")->nullable();
			$table->string("capacity")->nullable();
			$table->date("mfgt_date")->nullable();
			$table->integer("gross_wt")->default(0);
			$table->string("csc")->nullable();
			$table->integer("inspection_location_id")->default(0);
			$table->date("next_date")->nullable();
			$table->integer("tare_wt")->default(0);
			$table->boolean("imo_status")->default(0)->comment("1=import,0=export");
			$table->boolean("sealed")->default(0)->comment("1=Sealed,0=Unsealed");
			$table->integer("cleaning_location_id")->default(0);
			$table->date("survey_date")->nullable();
			$table->integer("customer_id")->default(0);
			$table->string("refno")->nullable();
			$table->integer("scover")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("bvboxyn")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->boolean("bvboxsu")->default(0)->comment("1=Sealed,0=Unsealed");
			$table->mediumtext("comments")->nullable();

			$table->integer("markings_fitted_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("markings_condition_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("marking_plates")->nullable();

			$table->integer("data_fitted_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("data_condition_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("data_plate")->nullable();

			$table->integer("owners_plate_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("owners_plate_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("owners_plate")->nullable();

			$table->integer("manufactures_plate_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("manufactures_plate_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("manufactures_plates")->nullable();

			$table->integer("csc_plate_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("csc_plate_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("csc_plate")->nullable();

			$table->integer("customs_plate_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("customs_plate_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("customs_plate")->nullable();

			$table->integer("prefix_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("prefix_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("prefix")->nullable();

			$table->integer("imo_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("imo_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("imo")->nullable();

			$table->integer("country_code_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("country_code_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("country_code")->nullable();

			$table->integer("rear_ladder_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("rear_ladder_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("rear_ladder")->nullable();

			$table->integer("front_ladder_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("front_ladder_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("front_ladder")->nullable();

			$table->integer("document_box_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("document_box_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("document_box")->nullable();

			$table->integer("outlet_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("outlet_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("outlet")->nullable();

			$table->integer("bottom_outlet_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("bottom_outlet_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("bottom_outlet")->nullable();

			$table->integer("foot_valve_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("foot_valve_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("foot_valve")->nullable();

			$table->integer("remote_footvalve_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("remote_footvalve_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("remote_footvalve")->nullable();

			$table->integer("steam_tubes_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("steam_tubes_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("steam_tubes")->nullable();

			$table->integer("condensate_drains_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("condensate_drains_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("condensate_drains")->nullable();

			$table->integer("thermometer_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("thermometer_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("thermometer")->nullable();

			$table->integer("walkway_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("walkway_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("walkway")->nullable();

			$table->integer("manlid_protection_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("manlid_protection_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("manlid_protection")->nullable();

			$table->integer("spillbox_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("spillbox_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("spillbox")->nullable();

			$table->integer("manlid_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("manlid_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("manlid")->nullable();

			$table->integer("manlid_bolts_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("manlid_bolts_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("manlid_bolts")->nullable();

			$table->integer("dipstick_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("dipstick_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("dipstick")->nullable();

			$table->integer("safety_cover_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("safety_cover_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("safety_cover")->nullable();

			$table->integer("calibration_chart_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("calibration_chart_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("calibration_chart")->nullable();

			$table->integer("relief_valves_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("relief_valves_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("relief_valves")->nullable();

			$table->integer("pressure_gauges_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("pressure_gauges_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("pressure_gauges")->nullable();

			$table->integer("flame_traps_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("flame_traps_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("flame_traps")->nullable();

			$table->integer("air_line_cap_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("air_line_cap_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("air_line_cap")->nullable();

			$table->integer("air_line_valve_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("air_line_valve_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("air_line_valve")->nullable();

			$table->integer("top_disch_prot_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("top_disch_prot_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("top_disch_prot")->nullable();

			$table->integer("top_disch_valve_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("top_disch_valve_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("top_disch_valve")->nullable();

			$table->integer("top_condition_yes")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("top_condition_good")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->mediumtext("top_condition")->nullable();
			
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
        Schema::dropIfExists('imo5_condition');
    }
};
