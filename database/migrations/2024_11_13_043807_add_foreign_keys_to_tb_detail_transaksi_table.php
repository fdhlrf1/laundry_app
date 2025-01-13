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
        Schema::table('tb_detail_transaksi', function (Blueprint $table) {
            $table->foreign('id_transaksi')->references('id')->on('tb_transaksi')->onDelete('cascade');
            $table->foreign('id_paket')->references('id')->on('tb_paket')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_detail_transaksi', function (Blueprint $table) {
            //
        });
    }
};