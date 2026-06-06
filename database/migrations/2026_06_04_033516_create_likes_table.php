<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('likes', function (Blueprint $table) {
        $table->id();
        // Le user_id de la personne qui aime l'article
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        // Le post_id de l'article qui est aimé
        $table->foreignId('post_id')->constrained()->onDelete('cascade');
        $table->timestamps();

        // Cette ligne évite qu'un utilisateur puisse aimer le même article deux fois !
        $table->unique(['user_id', 'post_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
