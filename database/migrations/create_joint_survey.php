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
        Schema::create('joint_survey', function (Blueprint $table) {
            $table->id();
			$table->string('ref_no')->nullable();
			$table->integer('company_id')->default(0);
			$table->string('date_of_issue')->nullable();
			$table->string('customer_name')->nullable();
			$table->string('company_name')->nullable();
			$table->string('instruction_1')->nullable();
			$table->string('instruction_2')->nullable();
			$table->string('instruction_3')->nullable();
			$table->string('tank_no')->nullable();
			$table->string('mfg_date')->nullable();
			$table->string('mgw')->nullable();
			$table->string('tare_weight')->nullable();
			$table->string('capacity')->nullable();
			$table->string('csc')->nullable();
			$table->string('comments')->nullable();
			$table->integer('surveyor_id')->default(0);
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
        Schema::dropIfExists('joint_survey');
    }
};
