<?php

namespace Database\Seeders;

use App\Models\Rent;
use App\Models\Role;
use App\Models\Room;
use App\Models\User;
use App\Models\Admin;
use App\Models\Faculty;
use App\Models\Building;
use Illuminate\Database\Seeder;
use App\Models\BackgroundAdminPhoto;
use App\Models\BackgroundLoginPhoto;
use App\Models\BackgroundUtamaPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        { {
            }
        }
        // \Ap{{ p\Mo }}dels\User::factory()->create([
        //    {{  'na }}me' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Role::create([
            'name' => 'admin',
        ]);

        Role::create([
            'name' => 'user',
        ]);

        User::create([
            'name' => 'Novi',
            'username' => 'Novi',
            'password' => bcrypt('admin'),
            'nomor_handphone' => '6285891791600',
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Joshua',
            'username' => 'Joshua',
            'password' => bcrypt('admin'),
            'nomor_handphone' => '6285891791500',
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Komunikasi',
            'username' => 'Komunikasi',
            'password' => bcrypt('Komunikasi'),
            'nomor_handphone' => '6285891791501',
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Aplikasi Informatika',
            'username' => 'Aplikasi',
            'password' => bcrypt('Aplikasi'),
            'nomor_handphone' => '6285891791502',
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Statistik dan Informasi',
            'username' => 'Statistik',
            'password' => bcrypt('Statistik'),
            'nomor_handphone' => '6285891791504',
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Infrastuktur TIK',
            'username' => 'Infrastuktur',
            'password' => bcrypt('Infrastruktur'),
            'nomor_handphone' => '6285891791505',
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Sekretariat',
            'username' => 'Sekretariat',
            'password' => bcrypt('Sekretariat'),
            'nomor_handphone' => '6285891791506',
            'role_id' => 2,
        ]);

        Room::create([
            'name' => 'Ruang Rapat Diskominfo',
            'img' => 'assets/images/ruangrapatdiskominfo3.jpg',
            'tempat' => 'Gedung Diskominfo Kabupaten Malang',
            'capacity' => '25',
            'description' => 'Jalan KH. Agus Salim Gedung C Lantai 3',
        ]);

        Room::create([
            'name' => ' Ruang Rapat Kepala Dinas',
            'img' => 'assets/images/RuangKepalaDinas.jpg',
            'tempat' => ' Gedung Diskominfo Kabupaten Malang',
            'capacity' => '10',
            'description' => 'Jalan KH. Agus Salim Gedung C Lantai 3',
        ]);

        Room::create([
            'name' => 'Ruang Command Center',
            'img' => 'assets/images/RuangCommandCenter.jpg',
            'tempat' => 'Gedung Sekretariat Pemkab Malang',
            'capacity' => '50',
            'description' => 'Jalan Panji no.158 Kepanjen Lantai 9',
        ]);
        // BACKGROUND HALAMAN UTAMA

        BackgroundUtamaPhoto::create([
            'img' => 'backgrounds/rapat.png',
        ]);

        BackgroundUtamaPhoto::create([
            'img' => 'backgrounds/rapat3.png',
        ]);
        // BACKGROUND HALAMAN LOGIN


        BackgroundLoginPhoto::create([
            'img' => 'backgrounds/Gapura Bupati.jpg',
        ]);

        BackgroundLoginPhoto::create([
            'img' => 'backgrounds/images1.jpg',
        ]);

        // BACKGROUND HALAMAN ADMIN

        BackgroundAdminPhoto::create([
            'code' => 'admin',
            'img' => 'backgrounds/bg.png',
        ]);

        BackgroundAdminPhoto::create([
            'code' => 'user',
            'img' => 'backgrounds/bg.png',
        ]);

        BackgroundAdminPhoto::create([
            'code' => 'ruangan',
            'img' => 'backgrounds/bg.png',
        ]);

        BackgroundAdminPhoto::create([
            'code' => 'pinjamSementara',
            'img' => 'backgrounds/bg.png',
        ]);

        BackgroundAdminPhoto::create([
            'code' => 'pinjamRuang',
            'img' => 'backgrounds/bg.png',
        ]);

        BackgroundAdminPhoto::create([
            'code' => 'fotoBackground',
            'img' => 'backgrounds/bg.png',
        ]);
        

    }
}
