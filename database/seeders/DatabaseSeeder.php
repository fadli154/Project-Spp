<?php

namespace Database\Seeders;

use App\Models\KonsentrasiKeahlian;
use App\Models\User;
use App\Models\WaliKelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(15)->create();
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'admin saya',
            'username' => 'admin',
            'level' => 'administrator',
            'password' => bcrypt('password'),
            'email' => 'admin154@gmail.com',
            'no_telp' => '08782730666',
        ]);

        User::create([
            'name' => 'wali Murid',
            'username' => 'wali',
            'wali_id' => 'WALI001',
            'level' => 'wali',
            'password' => bcrypt('password'),
            'email' => 'wali154@gmail.com',
            'no_telp' => '08782730656',
        ]);

        // Seeder Konsentrasi Keahlian Tabel
        KonsentrasiKeahlian::create([
            'id_kk' => 'KK0666',
            'konsentrasi_keahlian' => 'Rekayasa Perangkat Lunak',
            'tahun_program' => '3',
        ]);

        KonsentrasiKeahlian::factory(10)->create();

        // seeder Wali Kelas Table
        WaliKelas::create([
            'nama_wali_kelas' => 'Pak Anas',
            'nip_wali_kelas' => '111111111111111111',
            'jk' => 'L',
            'jabatan' => 'TK',
            'status_pegawai' => '1',
        ]);

        WaliKelas::factory(6)->create();
    }
}
