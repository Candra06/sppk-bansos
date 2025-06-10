<?php

namespace Database\Seeders;

use App\Models\Variabel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'variabel' => 'Usia',
                'kode' => 'K1',
            ],
            [
                'variabel' => 'Pekerjaan',
                'kode' => 'K2',
            ],
            [
                'variabel' => 'Penghasilan',
                'kode' => 'K3',
            ],
            [
                'variabel' => 'Tanggungan Keluarga',
                'kode' => 'K4',
            ],
            [
                'variabel' => 'Kondisi Atap',
                'kode' => 'K5',
            ],
            [
                'variabel' => 'Kondisi Dinding',
                'kode' => 'K6',
            ],
            [
                'variabel' => 'Kondisi Lantai',
                'kode' => 'K7',
            ],
            [
                'variabel' => 'Fasilitas Air',
                'kode' => 'K8',
            ],
            [
                'variabel' => 'Fasilitas Listrik',
                'kode' => 'K9',
            ],
            [
                'variabel' => 'Kepemilikan Rumah',
                'kode' => 'K10',
            ],
        ];

        foreach ($data as $value) {
            Variabel::create($value);
        }
    }
}
