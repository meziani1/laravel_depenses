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
        // Create depenses table
        DB::statement('DROP TABLE IF EXISTS depenses');
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->decimal('montant', 10, 2);
            $table->date('date_depense');
            $table->string('categorie');
            $table->timestamps();
        });

        // Create salaires table
        DB::statement('DROP TABLE IF EXISTS salaires');
        Schema::create('salaires', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->decimal('montant', 10, 2);
            $table->date('date_salaire');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
        Schema::dropIfExists('salaires');
    }
}; 