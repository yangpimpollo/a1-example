<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('name'); 
            $table->enum('role', ['admin', 'editor', 'cliente'])->default('cliente')->after('password');
            $table->string('avatar')->default('all_avatar/default-avatar.png')->nullable()->after('role');
            $table->string('phone', 9)->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'role', 'avatar', 'phone']);
        });
    }
};
