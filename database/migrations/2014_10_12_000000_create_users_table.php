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
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->date('date_of_joining')->nullable();
			$table->integer('department_id')->default(0);
			$table->string('employee_code')->nullable();
			$table->string('hierarchy_node_id')->nullable();
			$table->integer('customer_id')->default(0);
			$table->integer('role_id')->default(0);
			$table->boolean('status')->default(true);
			$table->integer("created_by");
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void{
		Schema::dropIfExists('users');
	}
};
