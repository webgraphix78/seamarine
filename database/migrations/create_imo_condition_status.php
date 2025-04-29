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
        Schema::create('imo_condition_status', function (Blueprint $table) {
            $table->id();
			$table->string('title');
			$table->string('code');
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
        Schema::dropIfExists('imo_condition_status');
    }
};
