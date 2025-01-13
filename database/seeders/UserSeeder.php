<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                'id_outlet' => null,
                'nama' => 'Fadhil Rafi Fauzan',
                'username' => 'super_admin',
                'password' => Hash::make('superadmin'),
                'role' => 'super_admin',
            ],
            [
                'id_outlet' => null,
                'nama' => 'Rudi Nugroho',
                'username' => 'super_owner ',
                'password' => Hash::make('superowner'),
                'role' => 'super_owner',
            ],
            [
                'id_outlet' => 1,
                'nama' => 'Fandy Wijaya',
                'username' => 'admin1',
                'password' => Hash::make('admin1'),
                'role' => 'admin',
            ],
            [
                'id_outlet' => 1,
                'nama' => 'Rizky Purnama',
                'username' => 'kasir1',
                'password' => Hash::make('kasir1'),
                'role' => 'kasir',
            ],
            [
                'id_outlet' => 1,
                'nama' => 'Jafar Shadiq',
                'username' => 'owner1',
                'password' => Hash::make('owner1'),
                'role' => 'owner',
            ],
            // [
            //     'id_outlet' => 2,
            //     'nama' => 'admin2',
            //     'username' => 'admin2',
            //     'password' => Hash::make('admin2'),
            //     'role' => 'admin',
            // ],
            // [
            //     'id_outlet' => 2,
            //     'nama' => 'kasir2',
            //     'username' => 'kasir2',
            //     'password' => Hash::make('kasir2'),
            //     'role' => 'kasir',
            // ],
            // [
            //     'id_outlet' => 2,
            //     'nama' => 'owner2',
            //     'username' => 'owner2',
            //     'password' => Hash::make('owner2'),
            //     'role' => 'owner',
            // ],
        ];

        foreach ($data as $value) {
            User::create([
                'id_outlet' => $value['id_outlet'],
                'nama' => $value['nama'],
                'username' => $value['username'],
                'password' => $value['password'],
                'role' => $value['role'],
            ]);
        }
    }
}
