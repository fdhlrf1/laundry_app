<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_next_kode_invoice');

        DB::statement(
            "CREATE VIEW view_next_kode_invoice AS
        SELECT (SELECT IF(COUNT(*) = 0, 'INV0001',
         (SELECT CONCAT(RPAD('INV', LENGTH(kode_invoice) - LENGTH(RIGHT(kode_invoice,4) + 1),'0'),
         RIGHT(kode_invoice,4) + 1) FROM tb_transaksi ORDER BY kode_invoice DESC LIMIT 1))
          FROM tb_transaksi) as nextkodeinvoice;"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_next_kode_invoice');
    }
};