<?php

namespace Database\Seeders;

use App\Models\ComparisonSubCriteria;
use App\Models\Criteria;
use App\Models\Patient;
use App\Models\PatientCriteria;
use App\Models\SubCriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Sunarti',
                'nik' => '1234567890',
                'gender' => 'Perempuan',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '1990-01-01',
                'address' => 'Jl. Jendral Sudirman No. 1',
            ],
            [
                'name' => 'Mudji',
                'nik' => '0987654321',
                'gender' => 'Laki-laki',
                'place_of_birth' => 'Bandung',
                'date_of_birth' => '1991-02-02',
                'address' => 'Jl. Jendral Sudirman No. 2',
            ],
            [
                'name' => 'Maemunah',
                'nik' => '1234567891',
                'gender' => 'Perempuan',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '1990-01-01',
                'address' => 'Jl. Jendral Sudirman No. 1',
            ],
            [
                'name' => 'Kresno',
                'nik' => '09876543211',
                'gender' => 'Laki-laki',
                'place_of_birth' => 'Bandung',
                'date_of_birth' => '1991-02-02',
                'address' => 'Jl. Jendral Sudirman No. 2',
            ],
            [
                'name' => 'Kusmirah',
                'nik' => '1234567851',
                'gender' => 'Perempuan',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '1990-01-01',
                'address' => 'Jl. Jendral Sudirman No. 1',
            ],
            [
                'name' => 'Karmadi',
                'nik' => '09816543211',
                'gender' => 'Laki-laki',
                'place_of_birth' => 'Bandung',
                'date_of_birth' => '1991-02-02',
                'address' => 'Jl. Jendral Sudirman No. 2',
            ],
            [
                'name' => 'Lasmunti',
                'nik' => '1234267851',
                'gender' => 'Perempuan',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '1990-01-01',
                'address' => 'Jl. Jendral Sudirman No. 1',
            ],
            [
                'name' => 'Marsam',
                'nik' => '09816443211',
                'gender' => 'Laki-laki',
                'place_of_birth' => 'Bandung',
                'date_of_birth' => '1991-02-02',
                'address' => 'Jl. Jendral Sudirman No. 2',
            ],
            [
                'name' => 'Zainuri',
                'nik' => '1284567851',
                'gender' => 'Perempuan',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '1990-01-01',
                'address' => 'Jl. Jendral Sudirman No. 1',
            ],
            [
                'name' => 'Musiyar',
                'nik' => '09016543211',
                'gender' => 'Laki-laki',
                'place_of_birth' => 'Bandung',
                'date_of_birth' => '1991-02-02',
                'address' => 'Jl. Jendral Sudirman No. 2',
            ],
            [
                'name' => 'Cholifah',
                'nik' => '1234367851',
                'gender' => 'Perempuan',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '1990-01-01',
                'address' => 'Jl. Jendral Sudirman No. 1',
            ],
            [
                'name' => 'Sukidong',
                'nik' => '19816543211',
                'gender' => 'Laki-laki',
                'place_of_birth' => 'Bandung',
                'date_of_birth' => '1991-02-02',
                'address' => 'Jl. Jendral Sudirman No. 2',
            ],
            [
                'name' => 'Susiyanto',
                'nik' => '9234567851',
                'gender' => 'Laki-laki',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '1990-01-01',
                'address' => 'Jl. Jendral Sudirman No. 1',
            ],
        ];

        $criterias = Criteria::all();
        if ($criterias->count() > 0) {
            foreach ($data as $item) {
                $patient = Patient::create($item);
                $value_array = [];
                foreach ($criterias as $key => $criteria) {
                    $subCriteria = SubCriteria::where('criteria_id', $criteria->id)->first();
                    $value_array[$criteria->code] = $subCriteria->code;
                }
                $values = json_encode($value_array);
                PatientCriteria::create([
                    'patient_id' => $patient->id,
                    'values' => $values,
                ]);
            }
        } else {
            foreach ($data as $item) {
                Patient::create($item);
            }
        }

        $allPatientCriterias = PatientCriteria::all();
        foreach ($allPatientCriterias as $patientCriteria) {
            $values = json_decode($patientCriteria->values);
            foreach ($values as $key => $value) {
                $subCriteria = SubCriteria::where('code', $value)->first();
                $comparisonSubCriteria = new ComparisonSubCriteria();
                $comparisonSubCriteria->criteria_id = $subCriteria->criteria->id;
                $comparisonSubCriteria->sub_criteria_id = $subCriteria->id;
                $comparisonSubCriteria->patient_id = $patientCriteria->patient->id;
                $comparisonSubCriteria->value = $subCriteria->value;
                $comparisonSubCriteria->save();
            }
        }
    }
}
