<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    Staff::create([
        'staff_no' => '2134',
        'staff_nama' => 'Abu Hanifah bin Mohd ',
        'staff_jawatan' => 'Juruteknik Komputer FT19',
        'staff_kelayakan' => '1200'
    ]);

    Staff::create([
        'staff_no' => '1887',
        'staff_nama' => 'Nurul LailaTizwani binti Ismail',
        'staff_jawatan' => 'Pembantu Tadbir N19',
        'staff_kelayakan' => '1200'
    ]);

    Staff::create([
        'staff_no' => '1661',
        'staff_nama' => 'Darma Iskandar bin kamal ',
        'staff_jawatan' => 'Juruteknik Komputer FT19',
        'staff_kelayakan' => '1200'
    ]);

    Staff::create([
        'staff_no' => '1657',
        'staff_nama' => 'Mohd Badrul Hisham bin Salleh ',
        'staff_jawatan' => 'Juruteknik Komputer FT19',
        'staff_kelayakan' => '1200'
    ]);
}
}
