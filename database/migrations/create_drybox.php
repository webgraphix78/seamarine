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
        Schema::create('drybox', function (Blueprint $table) {
            $table->id();
			$table->string('ref')->nullable();
			$table->integer('company_id');
			$table->integer('inspection_location_id');
			$table->date('inspection_date');
			$table->string('container_no')->nullable();
			$table->string('size')->nullable();
			$table->integer('tare_wt')->default(0);
			$table->integer('gross_wt')->default(0);
			$table->string('csc_no')->nullable();
			$table->date('mfgt_date')->nullable();
			$table->integer('customer_id');
			$table->integer('surveyor_id');
			$table->string('rear_end')->nullable();
			$table->string('right_side')->nullable();
			$table->string('front_end')->nullable();
			$table->string('left_side')->nullable();
			$table->string('top_roof')->nullable();
			$table->string('under_structure')->nullable();
			$table->string('interior')->nullable();
			$table->integer('drybox_status')->default(0)->comment('0=Empty,1=Loaded');
			$table->mediumText('note')->nullable();
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
        Schema::dropIfExists('drybox');
    }
};
