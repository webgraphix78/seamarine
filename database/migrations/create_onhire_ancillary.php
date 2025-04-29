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
        Schema::create('onhire_ancillary', function (Blueprint $table) {
            $table->id();
            $table->integer('onhire_id')->default(0);
			$table->string('ancf_1')->nullable();
			$table->integer('ancf_1_cladding')->default(0)->comment('NA,SS/ALU,SS,ALU,GRP');

			$table->string('ancf_2')->nullable();
			$table->integer('ancf_2_ladder')->default(0)->comment('NA,Front,Rear Ladder,Front Ladder & Rear Ladder');
			$table->integer('ancf_2_ladder_type')->default(0)->comment('NA,IRON,SS,ALU,Galvanized');

			$table->string('ancf_3')->nullable();
			$table->integer('ancf_3_placard')->default(0)->comment('NA,0,1,2 ..... 20');

			$table->string('ancf_4')->nullable();
			$table->integer('ancf_4_decals')->default(0)->comment('NA,Weight/Capacity,Foodlogo');
			
			$table->string('ancf_5')->nullable();
			$table->integer('ancf_5_tgauge')->default(0)->comment('Fortvale,Perolo,Other');
			$table->string('ancf_5_other')->nullable();
			$table->string('ancf_5_temperature')->nullable();
			$table->integer('ancf_5_ttype')->default(0)->comment('NA,Analog,Digital');

			$table->string('ancf_6')->nullable();
			$table->string('ancf_6_doc_tube')->nullable();

			$table->string('ancf_7')->nullable();
			$table->string('ancf_7_steam_tube')->nullable();
			$table->integer('ancf_7_steam_tube_value_1')->default(0)->comment('BSP');
			$table->integer('ancf_7_steam_tube_value_2')->default(0)->comment('NA,SS,PVC,ALU,BRASS');

			$table->string('ancf_8')->nullable();
			$table->string('ancf_8_steam_acc')->nullable();
			$table->integer('ancf_8_steam_acc_value')->default(0)->comment('NA,X Drainvalve,X Pv');

			$table->string('ancf_9')->nullable();
			$table->integer('ancf_9_bottom_comp')->default(0)->comment('NA,IRON,SS,ALU');

			$table->string('ancf_10')->nullable();
			$table->integer('ancf_10_electrical')->default(0)->comment('NA,Heating,Cooling');
			$table->string('ancf_10_manufacturer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onhire_ancillary');
    }
};
