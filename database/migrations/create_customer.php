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
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
			$table->string('name');
			$table->string('contact_person')->nullable();
			$table->string('fax_number')->nullable();
			$table->text('address')->nullable();
			$table->string('email')->nullable();
			$table->string('mobile_number')->nullable();
			$table->boolean('is_cha')->default(false);
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
        Schema::dropIfExists('customer');
    }
};
