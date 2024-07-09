<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'criteria_id' => 1,
                'name' => 'Tekanan Darah Normal',
                'code' => 'SC1',
                'value' => 1,
            ],
            [
                'criteria_id' => 1,
                'name' => 'Tekanan Darah Naik',
                'code' => 'SC2',
                'value' => 2,
            ],
            [
                'criteria_id' => 1,
                'name' => 'Tekanan Darah Hipertensi',
                'code' => 'SC3',
                'value' => 3,
            ],
            [
                'criteria_id' => 2,
                'name' => 'Tidak',
                'code' => 'SC4',
                'value' => 1,
            ],
            [
                'criteria_id' => 2,
                'name' => 'Tidak Tahu',
                'code' => 'SC5',
                'value' => 2,
            ],
            [
                'criteria_id' => 2,
                'name' => 'Ya',
                'code' => 'SC6',
                'value' => 3,
            ],
            [
                'criteria_id' => 3,
                'name' => 'Tidak',
                'code' => 'SC7',
                'value' => 1,
            ],
            [
                'criteria_id' => 3,
                'name' => 'Tidak Tahu',
                'code' => 'SC8',
                'value' => 2,
            ],
            [
                'criteria_id' => 3,
                'name' => 'Ya',
                'code' => 'SC9',
                'value' => 3,
            ],
            [
                'criteria_id' => 4,
                'name' => 'Tidak',
                'code' => 'SC10',
                'value' => 1,
            ],
            [
                'criteria_id' => 4,
                'name' => 'Tidak Tahu',
                'code' => 'SC11',
                'value' => 2,
            ],
            [
                'criteria_id' => 4,
                'name' => 'Ya',
                'code' => 'SC12',
                'value' => 3,
            ],
            [
                'criteria_id' => 5,
                'name' => 'Tidak',
                'code' => 'SC13',
                'value' => 1,
            ],
            [
                'criteria_id' => 5,
                'name' => 'Tidak Tahu',
                'code' => 'SC14',
                'value' => 2,
            ],
            [
                'criteria_id' => 5,
                'name' => 'Ya',
                'code' => 'SC15',
                'value' => 3,
            ],
            [
                'criteria_id' => 6,
                'name' => 'Tidak',
                'code' => 'SC16',
                'value' => 1,
            ],
            [
                'criteria_id' => 6,
                'name' => 'Tidak Tahu',
                'code' => 'SC17',
                'value' => 2,
            ],
            [
                'criteria_id' => 6,
                'name' => 'Ya',
                'code' => 'SC18',
                'value' => 3,
            ],
            [
                'criteria_id' => 7,
                'name' => 'Normal',
                'code' => 'SC19',
                'value' => 1,
            ],
            [
                'criteria_id' => 7,
                'name' => 'Overweight',
                'code' => 'SC20',
                'value' => 2,
            ],
            [
                'criteria_id' => 7,
                'name' => 'Obase 1',
                'code' => 'SC21',
                'value' => 3,
            ],
            [
                'criteria_id' => 8,
                'name' => 'Tidak Pernah',
                'code' => 'SC22',
                'value' => 1,
            ],
            [
                'criteria_id' => 8,
                'name' => 'Pernah',
                'code' => 'SC23',
                'value' => 2,
            ],
            [
                'criteria_id' => 8,
                'name' => 'Sering',
                'code' => 'SC24',
                'value' => 3,
            ],
        ];

        foreach ($data as $item) {
            \App\Models\SubCriteria::create($item);
        }
    }
}
