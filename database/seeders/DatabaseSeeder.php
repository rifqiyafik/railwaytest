<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Admin Default
        |--------------------------------------------------------------------------
        */
        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'ptpn4@gmail.com',
            'password' => Hash::make('medan123'),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Seeder Asal Sekolah
        |--------------------------------------------------------------------------
        */
        $schools = [
            [
                'nama_sekolah'   => 'SMK Negeri 1 Medan',
                'alamat_sekolah' => 'Jl. Cik Ditiro No. 19, Medan'
            ],
            [
                'nama_sekolah'   => 'SMK Negeri 12 Medan',
                'alamat_sekolah' => 'Jl. Pancing I, Medan Estate'
            ],
            [
                'nama_sekolah'   => 'SMK Negeri 2 Medan',
                'alamat_sekolah' => 'Jl. Gelas No. 30, Medan'
            ],
            [
                'nama_sekolah'   => 'Universitas Muhammadiyah Sumatera Utara (UMSU)',
                'alamat_sekolah' => 'Jl. Muchtar Basri No. 3, Medan'
            ],
            [
                'nama_sekolah'   => 'Universitas Sumatera Utara (USU)',
                'alamat_sekolah' => 'Jl. Dr. Mansyur No. 5, Medan'
            ],
        ];

        DB::table('asal_sekolahs')->truncate();
        DB::table('asal_sekolahs')->insert($schools);

        /*
        |--------------------------------------------------------------------------
        | Seeder Penempatan
        |--------------------------------------------------------------------------
        */
        $placements = [
            ['name' => 'Bagian Pengadaan dan Teknologi Informasi'],
            ['name' => 'Bagian Tanaman'],
            ['name' => 'Bagian Pengolahan/Pabrik'],
            ['name' => 'Bagian Akuntansi & Keuangan'],
            ['name' => 'Bagian Sumber Daya Manusia (SDM) & Umum'],
            ['name' => 'Bagian Teknik/Enjiniring'],
            ['name' => 'Bagian Pemasaran & Logistik'],
            ['name' => 'Satuan Pengawasan Intern (SPI) Regional'],
            ['name' => 'Unit Usaha/Kebun'],
        ];

        DB::table('penempatans')->truncate();
        DB::table('penempatans')->insert($placements);

        /*
        |--------------------------------------------------------------------------
        | Seeder Siswa (100 Data Realistis)
        |--------------------------------------------------------------------------
        */
        DB::table('siswas')->truncate();

        $faker = Faker::create('id_ID');

        $kecamatanMedan = [
            'Medan Timur',
            'Medan Tuntungan',
            'Medan Baru',
            'Medan Helvetia',
            'Medan Denai',
            'Medan Marelan',
            'Medan Johor',
            'Medan Kota',
            'Medan Sunggal',
            'Medan Amplas',
            'Medan Labuhan'
        ];

        for ($i = 1; $i <= 1000; $i++) {

            $jenisKelamin = $faker->randomElement(['l', 'p']);
            $defaultImage = ($jenisKelamin == 'l') ? 'default.png' : 'default2.png';

            $alamat = "Jl. " . $faker->streetName . " No. " . rand(1, 200)
                . ", " . $faker->randomElement($kecamatanMedan);

            DB::table('siswas')->insert([
                'nama_siswa'    => $faker->name,
                'id_siswa'      => rand(10000000, 99999999),
                'tmpt_lahir'    => $faker->city,
                'tgl_lahir'     => $faker->date('Y-m-d'),
                'jenis_kelamin' => $jenisKelamin,
                'alamat'        => $alamat,
                'sekolah_id'    => rand(1, count($schools)),
                'penempatan_id' => rand(1, count($placements)),
                'tgl_masuk'     => $faker->dateTimeBetween('-3 months', 'now'),
                'tgl_keluar'    => $faker->dateTimeBetween('now', '+3 months'),
                'no_hp'         => $faker->numerify('08##########'),

                //Logika default image
                'image'         => $defaultImage,

                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        }
    }
}
