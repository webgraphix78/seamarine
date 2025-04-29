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
        Schema::create('onhire_unitnr', function (Blueprint $table) {
            $table->id();
            $table->integer('onhire_id')->default(0);
			$table->string('unit_nr_1')->nullable();
			$table->integer('unit_nr_1_calibration')->default(0)->comment('NA,Stainless steel,Paper');
			$table->integer('unit_nr_1_calibration_value')->default(0)->comment('NA,In Spillbox,In Cover,On Cladding,On Manlid');

			$table->string('unit_nr_2')->nullable();
			$table->integer('unit_nr_2_manlid_swing')->default(0)->comment('NA,4 Bolted,6 Bolted,8 Bolted,16x/20x');
			$table->integer('unit_nr_2_manlid_swing_value')->default(0)->comment('NA,Fortvale,Perolo,Swift,X Securing Ring,Other');
			$table->string('unit_nr_2_manlid_swing_other')->nullable();

			$table->string('unit_nr_3')->nullable();
			$table->string('unit_nr_3_collapsible')->nullable();

			$table->string('unit_nr_4')->nullable();
			$table->integer('unit_nr_4_dipstick')->default(0)->comment('NA,Angle,Flat');
			$table->integer('unit_nr_4_dipstick_value')->default(0)->comment('NA,Legible,Bracket');

			$table->string('unit_nr_5')->nullable();
			$table->integer('unit_nr_5_topcover')->default(0)->comment('NA,SS,Alu,Iron');

			$table->string('unit_nr_6')->nullable();
			$table->integer('unit_nr_6_walkway')->default(0)->comment('NA,SS,Alu');

			$table->string('unit_nr_7')->nullable();
			$table->integer('unit_nr_7_manlid_gasket')->nullable()->comment('NA,SWR,PTPE,Viton A,Super Tanktyt,Other');
			$table->string('unit_nr_7_manlid_gasket_other')->nullable();

			$table->string('unit_nr_8')->nullable();
			$table->integer('unit_nr_8_grounding')->default(0)->comment('1=Yes,0=No');

			$table->string('unit_nr_9')->nullable();
			$table->integer('unit_nr_9_bottomplate')->default(0)->comment('-1=NA,1=Yes,0=No');

			$table->string('unit_nr_10')->nullable();
			$table->integer('unit_nr_10_pti_date')->default(0)->comment('NA,Cable +/-,Mtr,Splice,Plug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onhire_unitnr');
    }
};
