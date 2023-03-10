<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LawyerData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sql = base_path('database/data/lawyers.sql');

        DB::unprepared(
            file_get_contents($sql)
        );


    }
}
