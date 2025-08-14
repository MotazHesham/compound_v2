<?php

namespace Database\Seeders;

use App\Models\MalfunctionType;
use Illuminate\Database\Seeder;

class MalfunctionTypeTableSeeder extends Seeder
{
    public function run()
    {
        $malfunctionTypes = [
            [
                'id'   => 1,
                'name' => 'Electrical',
            ],
            [
                'id'   => 2,
                'name' => 'Mechanical',
            ],
            [
                'id'   => 3,
                'name' => 'Plumbing',
            ],
            [
                'id'   => 4,
                'name' => 'HVAC',
            ],
            [
                'id'   => 5,
                'name' => 'Structural',
            ],
        ];

        MalfunctionType::insert($malfunctionTypes);
    }
}
