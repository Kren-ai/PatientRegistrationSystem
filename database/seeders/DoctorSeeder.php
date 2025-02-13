<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctors')->insert([
            ['name' => 'Dr. Mylene Infante', 'specialization' => 'General Medicine', 'contact_number' => '09123123123'],
            ['name' => 'Dr. Kaye', 'specialization' => 'General Medicine', 'contact_number' => '09123123122'],
        ]);
    }
}
