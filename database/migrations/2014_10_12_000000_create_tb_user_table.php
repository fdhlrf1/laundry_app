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
        Schema::create('tb_user', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_outlet')->nullable();
            $table->string('nama', 100);
            $table->string('username', 30)->unique();
            $table->text('password');
            $table->enum('role', ['super_admin', 'super_owner', 'admin', 'kasir', 'owner']);
            // $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_user');
    }
};
