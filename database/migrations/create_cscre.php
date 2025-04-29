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
        Schema::create('cscre', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no');
            $table->integer('company_id')->nullable();
            $table->string('request_of_name')->nullable();
            $table->string('attend')->nullable();
            $table->string('of_name')->nullable();
            $table->string('attend_day')->nullable();
            $table->string('attend_month')->nullable();
            $table->string('unit_no')->nullable();
            $table->string('csc_approval_no')->nullable();
            $table->string('mfg')->nullable();
            $table->string('mfg_date')->nullable();
            $table->string('mfg_serial_no')->nullable();
            $table->string('container_type')->nullable();
            $table->string('iso_type')->nullable();
            $table->string('next_csc_inspection_date')->nullable();
            $table->string('csc_reinspection_date')->nullable();
            $table->string('survey_without_prejudice')->nullable();

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
        Schema::table('cscre', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
    }
};
