<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('data_user', function (Blueprint $table) {
            $table->enum('role', ['admin', 'user'])->default('user')->after('email');
        });

        // Insert sample data - admin and user
        DB::table('data_user')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@funcar.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Demo',
                'email' => 'user@funcar.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Delete sample data first
        DB::table('data_user')->whereIn('email', ['admin@funcar.com', 'user@funcar.com'])->delete();

        Schema::table('data_user', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
