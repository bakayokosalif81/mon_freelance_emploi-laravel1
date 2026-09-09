<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['client', 'freelance', 'admin'])->default('freelance')->after('email');
            $table->text('bio')->nullable()->after('role');
            $table->string('competences')->nullable()->after('bio');
            $table->string('photo')->nullable()->after('competences');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'bio', 'competences', 'photo']);
        });
    }
};