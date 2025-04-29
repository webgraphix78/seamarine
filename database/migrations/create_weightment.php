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
        Schema::create('weightment', function (Blueprint $table) {
            $table->id();
			$table->string("ref_no")->nullable();
			$table->integer("company_id")->default(0);
			$table->integer("customer_id")->default(0);
			$table->string("subject")->nullable();
			$table->mediumtext("field_1_key")->nullable();
			$table->string("field_1_value_1")->nullable();
			$table->string("field_1_value_2")->nullable();
			$table->mediumtext("field_2_key")->nullable();
			$table->string("field_2_value_1")->nullable();
			$table->string("field_2_value_2")->nullable();
			$table->mediumtext("field_3_key")->nullable();
			$table->string("field_3_value_1")->nullable();
			$table->string("field_3_value_2")->nullable();
			$table->mediumtext("field_4_key")->nullable();
			$table->string("field_4_value_1")->nullable();
			$table->string("field_4_value_2")->nullable();
			$table->mediumtext("field_5_key")->nullable();
			$table->string("field_5_value_1")->nullable();
			$table->string("field_5_value_2")->nullable();
			$table->mediumtext("comments")->nullable();
			$table->integer("surveyor_id")->default(0);
			$table->date("date_of_issue")->nullable();
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
        Schema::dropIfExists('weightment');
    }
};
