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
        Schema::disableForeignKeyConstraints();

        Schema::create('prodajas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kupac_id')->constrained('kupacs');
            $table->foreignId('agent_id')->constrained('agents');
            $table->foreignId('nekretnina_id')->constrained('nekretninas');
            $table->date('datum_kreiranja');
            $table->string('status')->default('nacrt');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodajas');
    }
};
