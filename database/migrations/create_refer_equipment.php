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
        Schema::create('refer_equipment', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no');
            $table->integer('company_id')->nullable();
            $table->date('inspection_date')->nullable(); 
            $table->integer('inspection_location_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('tank_no')->nullable();
            $table->string('shipping_agency')->nullable();
            $table->string('container_type')->nullable();
            $table->string('booking_no')->nullable();
            $table->string('model')->nullable();
            $table->string('serial')->nullable();
            $table->string('in_service')->nullable();
            $table->string('date_of_last_pretrip')->nullable();
            $table->string('run_through')->nullable();
            $table->string('temperature_set_pti')->nullable();
            $table->string('temperature_set_rechecked')->nullable();
            $table->string('exterior')->nullable();
            $table->string('exterior_right')->nullable();
            $table->string('exterior_left')->nullable();
            $table->string('exterior_front')->nullable();
            $table->string('exterior_roof')->nullable();
            $table->string('exterior_under')->nullable();
            $table->string('exterior_rear')->nullable();
            $table->string('exterior_rear_door_right')->nullable();
            $table->string('exterior_rear_door_left')->nullable();
            $table->string('seaworthiness')->nullable();
            $table->string('interior')->nullable();
            $table->string('interior_right')->nullable();
            $table->string('interior_left')->nullable();
            $table->string('interior_front')->nullable();
            $table->string('interior_ceiling')->nullable();
            $table->string('interior_floor')->nullable();
            $table->string('interior_rear')->nullable();
            $table->string('interior_rear_door_right')->nullable();
            $table->string('interior_rear_door_left')->nullable();
            $table->string('clean_free_from_odour')->nullable();
            $table->string('cable_440')->nullable();
            $table->string('controller')->nullable();
            $table->string('transformer')->nullable();
            $table->string('mcb')->nullable();
            $table->string('compressor')->nullable();
            $table->string('unit_bolts_fasteners')->nullable();
            $table->string('power_plug_440')->nullable();
            $table->string('contactors')->nullable();
            $table->string('battery')->nullable();
            $table->string('display_board')->nullable();
            $table->string('wiring_terminals')->nullable();
            $table->string('refg_run_through')->nullable();
            $table->string('comments')->nullable();
            $table->integer('surveyor_id')->nullable();

            $table->boolean('status')->default(true);
			$table->integer('created_by')->default(1);
            $table->softDeletes();

            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('refer_equipment', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
    }
};
