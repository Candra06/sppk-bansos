<?php

namespace Database\Seeders;

use App\Models\Himpunan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HimpunanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'variabel_id'=>'1',
                'himpunan'=>'Muda',
            ],
            [
                'variabel_id'=>'1',
                'himpunan'=>'Menengah',
            ],
            [
                'variabel_id'=>'1',
                'himpunan'=>'Lanjut',
            ],
            [
                'variabel_id'=>'2',
                'himpunan'=>'Rendah',
            ],
            [
                'variabel_id'=>'2',
                'himpunan'=>'Menengah',
            ],
            [
                'variabel_id'=>'2',
                'himpunan'=>'Tinggi',
            ],
            [
                'variabel_id'=>'3',
                'himpunan'=>'Rendah',
            ],
            [
                'variabel_id'=>'3',
                'himpunan'=>'Sedang',
            ],
            [
                'variabel_id'=>'3',
                'himpunan'=>'Tinggi',
            ],
            [
                'variabel_id'=>'4',
                'himpunan'=>'Buruk',
            ],
            [
                'variabel_id'=>'4',
                'himpunan'=>'Cukup',
            ],
            [
                'variabel_id'=>'4',
                'himpunan'=>'Baik',
            ],
            [
                'variabel_id'=>'4',
                'himpunan'=>'Sangat Baik',
            ],
            [
                'variabel_id'=>'5',
                'himpunan'=>'Tidak Ada',
            ],
            [
                'variabel_id'=>'5',
                'himpunan'=>'Sedikit',
            ],
            [
                'variabel_id'=>'5',
                'himpunan'=>'Banyak',
            ],
            [
                'variabel_id'=>'5',
                'himpunan'=>'Sangat Banyak',
            ],
        ];

        foreach ($data as $key => $item) {
            Himpunan::create($item);
        }
    }
}
