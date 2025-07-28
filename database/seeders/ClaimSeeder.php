<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Claim;


class ClaimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Claim::create([
            'user_id' => 1, // pastikan user dengan id=1 wujud
            'nama_staff' => 'syazwani',
            'nama_klinik' => 'Klinik Kesihatan Kuala Terengganu',
            'no_resit' => 'RES123456',
            'jumlah_resit' => 150.00,
            'jumlah_semasa' => 150.00,
            'kelayakan' => 500.00,
            'jumlah_diambil' => 150.00,
            'baki' => 350.00,
            'bulan' => 'Januari',
            'resit_path' => 'resit/resit123.jpg',
            'status' => 'Baharu',
        ]);
    }
}
