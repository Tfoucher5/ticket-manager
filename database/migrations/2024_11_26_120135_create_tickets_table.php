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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('titre')->default('Je suis le titre par défaut');
            $table->text('description');
            $table->foreignId('categorie_id')->constrained('categories')->default(1);
            $table->foreignId('priorite_id')->constrained('priorites')->default(1);
            $table->enum('statut', ['Ouvert', 'Assigné', 'Résolu', 'Annulé'])->default('Ouvert');
            $table->foreignId('developpeur_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
