<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            ['name' => 'Jabatan Khidmat Pengurusan'],
            ['name' => 'Jabatan Kewangan'],
            ['name' => 'Jabatan Teknologi maklumat'],
            ['name' => 'Jabatan Perancangan'],
            ['name' => 'Jabatan Kejuruteraan'],
            ['name' => 'Jabatan Penilaian & Pengurusan Harta'],
            ['name' => 'Jabatan Perlesenan'],
            ['name' => 'Jabatan Bangunan'],
            ['name' => 'Jabatan Landskap'],
    ]);
}}
