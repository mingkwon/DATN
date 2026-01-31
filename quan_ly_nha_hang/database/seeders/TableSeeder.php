<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Table;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    public function run()
    {
        $tables = [
            ['number'=>'A1', 'seats'=>4, 'zone'=>'indoor', 'pos_x'=>20, 'pos_y'=>25],
            ['number'=>'A2', 'seats'=>4, 'zone'=>'indoor', 'pos_x'=>35, 'pos_y'=>25],
            ['number'=>'A3', 'seats'=>4, 'zone'=>'indoor', 'pos_x'=>50, 'pos_y'=>25],
            ['number'=>'A4', 'seats'=>4, 'zone'=>'indoor', 'pos_x'=>65, 'pos_y'=>25],
            ['number'=>'A5', 'seats'=>4, 'zone'=>'indoor', 'pos_x'=>80, 'pos_y'=>25],

            ['number'=>'B1', 'seats'=>6, 'zone'=>'indoor', 'pos_x'=>20, 'pos_y'=>45],
            ['number'=>'B2', 'seats'=>6, 'zone'=>'indoor', 'pos_x'=>40, 'pos_y'=>45],
            ['number'=>'B3', 'seats'=>8, 'zone'=>'indoor', 'pos_x'=>65, 'pos_y'=>45],

            ['number'=>'VIP1', 'seats'=>12, 'zone'=>'indoor', 'pos_x'=>50, 'pos_y'=>15],

            ['number'=>'S1', 'seats'=>2, 'zone'=>'sushi_bar', 'pos_x'=>75, 'pos_y'=>38],
            ['number'=>'S2', 'seats'=>2, 'zone'=>'sushi_bar', 'pos_x'=>80, 'pos_y'=>38],
            ['number'=>'S3', 'seats'=>2, 'zone'=>'sushi_bar', 'pos_x'=>85, 'pos_y'=>38],

            ['number'=>'OUT1', 'seats'=>6, 'zone'=>'outdoor', 'pos_x'=>15, 'pos_y'=>80],
            ['number'=>'OUT2', 'seats'=>6, 'zone'=>'outdoor', 'pos_x'=>35, 'pos_y'=>85],
            ['number'=>'OUT3', 'seats'=>6, 'zone'=>'outdoor', 'pos_x'=>60, 'pos_y'=>85],
            ['number'=>'OUT4', 'seats'=>6, 'zone'=>'outdoor', 'pos_x'=>80, 'pos_y'=>80],
        ];

        foreach ($tables as $t) {
            Table::create($t);
        }
    }
}
