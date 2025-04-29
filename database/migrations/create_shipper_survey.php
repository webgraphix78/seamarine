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
        Schema::create('shipper_survey', function (Blueprint $table) {
            $table->id();
			$table->string("ref_no")->nullable();
			$table->date("survey_date")->nullable();
			$table->integer("company_id")->default(0);
			$table->string("last_cargo_carried")->nullable();
			$table->string("cha")->nullable();
			$table->string("tank_container_no");
			$table->integer("surveyor_id")->default(0);
			$table->integer("for_shipper_id")->default(0);
			$table->integer("customer_id")->default(0);
			$table->string("csc_no")->nullable();
			$table->string("type")->nullable();
			$table->integer("inspection_location_id")->default(0);
			$table->string("mfg_date")->nullable();
			$table->string("last_inspection_date")->nullable();
			$table->integer("capacity")->default(0);
			$table->string("next_date")->nullable();
			$table->string("ref")->nullable();
			$table->integer("gross_wt")->default(0);
			$table->integer("tare_wt")->default(0);
			$table->integer("frame_tank")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("manlid_valve")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("serial_nos")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("steam_jacket")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("bullet_seal")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("gasket_type")->default(0)->comment("1=Super Tyt, 2=Taflon, 3=Rubber, 4=Nylon");
			$table->integer("manlid_cover")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("distick")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("calibration")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("siphon_tube")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("pressure_gauge")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("temperature_gauge")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("prv_poppet")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("top_provision")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("interior_clean")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->integer("valves_free")->default(0)->comment("1=Yes,0=No,-1=NA");
			$table->string("non_transferable")->nullable();
			$table->string("polish_buffing")->nullable();
			$table->mediumtext("note")->nullable();
			$table->string("manlid_seal_no")->nullable();
			$table->string("airline_seal_no")->nullable();
			$table->string("bottom_seal_no")->nullable();
			$table->string("top_seal")->nullable();
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
        Schema::dropIfExists('shipper_survey');
    }
};
