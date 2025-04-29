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
        Schema::create('imo1', function (Blueprint $table) {
            $table->id();
			$table->string('ref_no')->nullable();
			$table->integer('company_id');
			$table->date('inspection_date')->nullable();
			$table->string('csc')->nullable();
			$table->string('loaded_at')->nullable();
			$table->integer('tank_type_id')->default(0);// tank type
			$table->string('tank_no')->nullable();
			$table->integer('tcode_id')->nullable();
			$table->string('last_cargo_carried')->nullable();
			$table->date('mfgt_date')->nullable();
			$table->integer('empty_clean')->default(-1)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('empty_dirty')->default(-1)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('cfs')->default(-1)->comment("1=In, 0=Out, -1=NA");
			$table->integer('for_client')->default(0);// master_customer
			$table->integer('loaded')->default(-1)->comment("1=Yes, 0=No, -1=NA");
			$table->date('next_date')->nullable();
			$table->integer('surveyor_id')->nullable();//master_surveyor
			$table->string('country')->nullable();
			$table->string('hazard_class')->nullable();
			$table->integer('inspection_location_id')->default(0); // inspection_location
			$table->integer('customer_id')->default(0); // master_customer
			$table->integer('cha_client')->default(-1)->comment("1=Yes, 0=No");
			$table->integer('imo1_status')->default(-1)->comment("1=Import, 0=Export");
			$table->string('walkway_image')->nullable();
			// tipped_at ???? [ hidden ]
			$table->date('last_inspection_date')->nullable();
			$table->integer('front_panel_cladding')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('front_panel_decals')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('rear_panel_cladding')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('rear_panel_decals')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('right_side_cladding')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('right_side_decals')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('left_side_cladding')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('left_side_decals')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('top_cladding')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('top_decals')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('underside_cladding')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('underside_decals')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('front_end_damage')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('rear_end_damage')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('right_side_damage')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('left_side_damage')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('top_damage')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('underside_damage')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('exterior_wash_needed')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('rusty_frame')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('patchy_cladding')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('product_spills')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('renew_logo')->default(0)->comment("1=Yes, 0=No, -1=NA");
			$table->integer('previous_haz')->default(0)->comment("1=Yes, 0=No, -1=NA");

			$table->string('ladder_nos')->nullable();
			$table->integer('ladder_cond_status_id')->default(0);
			$table->string('document_box_nos')->nullable();
			$table->integer('document_box_cond_status_id')->default(0);
			$table->string('temperature_gauge_nos')->nullable();
			$table->integer('temperature_gauge_cond_status_id')->default(0);
			$table->string('steam_nos')->nullable();
			$table->integer('steam_cond_status_id')->default(0);
			$table->string('steam_pressure_nos')->nullable();
			$table->integer('steam_pressure_cond_status_id')->default(0);
			$table->string('remote_system_nos')->nullable();
			$table->integer('remote_system_cond_status_id')->default(0);
			$table->string('electrical_heating_nos')->nullable();
			$table->integer('electrical_heating_cond_status_id')->default(0);
			$table->string('manlid_nos')->nullable();
			$table->integer('manlid_cond_status_id')->default(0);
			$table->string('manlid_swing_nos')->nullable();
			$table->integer('manlid_swing_cond_status_id')->default(0);
			$table->string('insp_hatch_nos')->nullable();
			$table->integer('insp_hatch_cond_status_id')->default(0);
			$table->string('insp_hatch_swing_bolt_no')->nullable();
			$table->integer('insp_hatch_swing_bolt_cond_status_id')->default(0);
			$table->string('spill_box_nos')->nullable();
			$table->integer('spill_box_cond_status_id')->default(0);
			$table->string('pre_valve_nos')->nullable();
			$table->integer('pre_valve_cond_status_id')->default(0);
			$table->string('pre_bursting_disc_nos')->nullable();
			$table->integer('pre_bursting_disc_cond_status_id')->default(0);
			$table->string('walkyway_ls_nos')->nullable();
			$table->integer('walkyway_ls_cond_status_id')->default(0);
			$table->string('walkyway_scs_nos')->nullable();
			$table->integer('walkyway_scs_cond_status_id')->default(0);
			$table->string('walkyway_mls_nos')->nullable();
			$table->integer('walkyway_mls_cond_status_id')->default(0);
			$table->string('airline_valve_nos')->nullable();
			$table->integer('airline_valve_cond_status_id')->default(0);
			$table->string('tank_gauge_nos')->nullable();
			$table->integer('tank_gauge_cond_status_id')->default(0);
			$table->string('dipstick_nos')->nullable();
			$table->integer('dipstick_cond_status_id')->default(0);
			$table->string('calibration_chart_nos')->nullable();
			$table->integer('calibration_chart_cond_status_id')->default(0);
			$table->string('syphon_pipe_nos')->nullable();
			$table->integer('syphon_pipe_cond_status_id')->default(0);
			$table->string('b_fly_valve_nos')->nullable();
			$table->integer('b_fly_valve_cond_status_id')->default(0);
			$table->string('blank_flange_nos')->nullable();
			$table->integer('blank_flange_cond_status_id')->default(0);
			$table->string('top_vapour_nos')->nullable();
			$table->integer('top_vapour_cond_status_id')->default(0);
			$table->string('top_vapour_bolts_nos')->nullable();
			$table->integer('top_vapour_bolts_cond_status_id')->default(0);
			$table->string('flanged_provision_nos')->nullable();
			$table->integer('flanged_provision_cond_status_id')->default(0);
			$table->string('bottom_foot_nos')->nullable();
			$table->integer('bottom_foot_cond_status_id')->default(0);
			$table->string('bottom_bfly_nos')->nullable();
			$table->integer('bottom_bfly_cond_status_id')->default(0);
			$table->string('bottom_outlet_flange_nos')->nullable();
			$table->integer('bottom_outlet_flange_cond_status_id')->default(0);
			$table->string('bottom_valve_handle_nos')->nullable();
			$table->integer('bottom_valve_handle_cond_status_id')->default(0);
			$table->string('bottom_bfly_ball_nos')->nullable();
			$table->integer('bottom_bfly_ball_cond_status_id')->default(0);
			$table->string('fusible_link_no')->nullable();
			$table->integer('fusible_link_cond_status_id')->default(0);

			$table->integer('camera')->default(0)->comment("1=Yes, 0=No");
			$table->integer('gps')->default(0)->comment("1=Yes, 0=No");
			$table->date('last_test_date')->nullable();
			$table->integer('tare_wt')->default(0);
			$table->integer('capacity')->default(0);
			$table->integer('mgw')->default(0);
			$table->mediumText('comments')->nullable();
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
        Schema::dropIfExists('imo1');
    }
};
