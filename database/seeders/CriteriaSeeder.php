<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'code' => 'C1',
                'name' => 'Tekanan Darah',
                'type' => 'benefit',
                'weight' => 2
            ],
            [
                'code' => 'C2',
                'name' => 'Riwayat Diabetes',
                'type' => 'benefit',
                'weight' => 3
            ],
            [
                'code' => 'C3',
                'name' => 'Darah Tinggi',
                'type' => 'benefit',
                'weight' => 3
            ],
            [
                'code' => 'C4',
                'name' => 'Anggota Gerak',
                'type' => 'benefit',
                'weight' => 5
            ],
            [
                'code' => 'C5',
                'name' => 'Gejala Pelo',
                'type' => 'benefit',
                'weight' => 5
            ],
            [
                'code' => 'C6',
                'name' => 'Nyeri Kepala',
                'type' => 'benefit',
                'weight' => 2
            ],
            [
                'code' => 'C7',
                'name' => 'Klasifikasi Status Gizi (WHO)',
                'type' => 'benefit',
                'weight' => 1
            ],
            [
                'code' => 'C8',
                'name' => 'Riwayat Merokok',
                'type' => 'benefit',
                'weight' => 1
            ],
        ];

        foreach ($data as $item) {
            \App\Models\Criteria::create($item);
        }
    }
}
