<?php

namespace Database\Seeders;

use App\Models\Outlet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Outlet::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                'nama' => ' Kilat Laundry Service',
                'alamat' => 'Jl. Pahlawan No.23, Bandung, Jawa Barat',
                'tlp' => '(022) 8765-4321',
            ],
            [
                'nama' => 'AquaFresh Laundry',
                'alamat' => 'Jl. Imam Bonjol No.19, Denpasar, Bali',
                'tlp' => '(0361) 5432-2109',
            ],
            // [
            //     'nama' => 'Outlet 3',
            //     'alamat' => 'Jl. Contoh No. 3, Surabaya',
            //     'tlp' => '023-453434554',
            // ],

        ];

        foreach ($data as $value) {
            Outlet::create([
                'nama' => $value['nama'],
                'alamat' => $value['alamat'],
                'tlp' => $value['tlp'],
            ]);
        }
    }
}
