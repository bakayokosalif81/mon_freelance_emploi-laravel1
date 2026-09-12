<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('offres', function (Blueprint $table) {
            $table->boolean('en_vedette')->default(false)->after('statut');
            $table->enum('vedette_statut', ['aucune', 'en_attente', 'active'])->default('aucune')->after('en_vedette');
        });
    }

    public function down(): void
    {
        Schema::table('offres', function (Blueprint $table) {
            $table->dropColumn(['en_vedette', 'vedette_statut']);
        });
    }
};
