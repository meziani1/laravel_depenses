<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop and recreate sessions table
        try {
            DB::statement('DROP TABLE IF EXISTS sessions');
            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->longText('payload');
                $table->integer('last_activity')->index();
            });
        } catch (\Exception $e) {
            // If sessions table already exists, skip it
        }

        // Create password reset tokens table if it doesn't exist
        if (!Schema::hasTable('password_reset_tokens')) {
            Schema::create('password_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }

        // Create depenses table if it doesn't exist
        if (!Schema::hasTable('depenses')) {
            Schema::create('depenses', function (Blueprint $table) {
                $table->id();
                $table->string('description');
                $table->decimal('montant', 10, 2);
                $table->date('date_depense');
                $table->string('categorie');
                $table->timestamps();
            });
        }

        // Create salaires table if it doesn't exist
        if (!Schema::hasTable('salaires')) {
            Schema::create('salaires', function (Blueprint $table) {
                $table->id();
                $table->string('description');
                $table->decimal('montant', 10, 2);
                $table->date('date_salaire');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('depenses');
        Schema::dropIfExists('salaires');
    }
}; 