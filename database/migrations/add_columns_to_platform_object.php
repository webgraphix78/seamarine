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
        Schema::table('platform_object', function (Blueprint $table) {
            //
			$table->string("section_title")->after('name');
			$table->json('permissions');
			// Deprecating these fields
			$table->dropColumn(['for_admin_only', 'hierarchical', 'category']);
			// Changes to fields
			// $table->json('role_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('platform_object', function (Blueprint $table) {
            //
        });
    }
};
