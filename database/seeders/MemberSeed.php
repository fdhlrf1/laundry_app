<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MemberSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Member::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                'nama' => 'Gilbert Chandra',
                'alamat' => 'Bandung',
                'jenis_kelamin' => 'L',
                'tlp' => '0954644565465',
            ],
            [
                'nama' => 'Endry',
                'alamat' => 'Cimahi',
                'jenis_kelamin' => 'L',
                'tlp' => '08763432434343',
            ],
        ];

        foreach ($data as $value) {
            Member::create([
                'nama' => $value['nama'],
                'alamat' => $value['alamat'],
                'jenis_kelamin' => $value['jenis_kelamin'],
                'tlp' => $value['tlp'],
            ]);
        }
    }
}
