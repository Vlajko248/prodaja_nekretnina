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
        Schema::create('nekretninas', function (Blueprint $table) {
            $table->id();
            $table->string('oznaka', 50)->unique();
            $table->decimal('povrsina_m2', 8, 2);
            $table->decimal('cena', 12, 2);
            $table->string('status')->default('slobodna');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nekretninas');
    }
};
