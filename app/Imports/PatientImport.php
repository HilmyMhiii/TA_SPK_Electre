<?php

namespace App\Imports;

use App\Models\ComparisonSubCriteria;
use App\Models\Criteria;
use App\Models\Patient;
use App\Models\PatientCriteria;
use App\Models\SubCriteria;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PatientImport implements ToModel, SkipsEmptyRows, WithStartRow, WithValidation
{
    public function startRow(): int
    {
        return 5;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            DB::beginTransaction();

            // konvrti format date dari 34041
            $phpDate = Carbon::create(1899, 12, 30)->addDays($row['5'])->format('Y-m-d');
            // cek tidak angka
            if (!is_numeric($row['13'])) {
                $row['13'] = null;
            }

            //hapus semua spasi
            $row = array_map('trim', $row);
            // hilangkan spasi pada wall type
            // $wall_type_input = preg_replace('/\s+/', '', $row['9']);

            $patient = Patient::create([
                'name' => $row['2'],
                'nik' => $row['1'],
                'gender' => $row['3'],
                'place_of_birth' => $row['4'],
                //format date
                'date_of_birth' => $phpDate,
                'address' => $row['6'],
            ]);

            $values = [];
            $criterias = Criteria::all();
            foreach ($criterias as $key => $criteria) {
                $subCriteria = SubCriteria::where('criteria_id', $criteria->id)->first();
                $values[$criteria->code] = $subCriteria->code;
            }

            $patientCriteria = new PatientCriteria();
            $patientCriteria->patient_id = $patient->id;
            $patientCriteria->values = json_encode($values);
            $patientCriteria->save();

            $allpatientCriterias = PatientCriteria::all();
            if ($allpatientCriterias->count() < 0) {
                foreach ($allpatientCriterias as $patientCriteria) {
                    $values = json_decode($patientCriteria->values);
                    foreach ($values as $key => $value) {
                        $subCriteria = SubCriteria::where('code', $value)->first();
                        $comparisonSubCriteria = new ComparisonSubCriteria();
                        $comparisonSubCriteria->criteria_id = $subCriteria->criteria->id;
                        $comparisonSubCriteria->sub_criteria_id = $subCriteria->id;
                        $comparisonSubCriteria->patient_id = $patientCriteria->id;
                        $comparisonSubCriteria->value = $subCriteria->value;
                        $comparisonSubCriteria->save();
                    }
                }
            } else {
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

            DB::commit();

            return $patient;
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            $errorMessage = 'Data yang diimport tidak valid';
            Session::flash('error', $errorMessage);

            return null;
        }
    }

    public function rules(): array
    {
        return [
            '1' => 'required|unique:patients,nik',
            '2' => 'required',
            '3' => 'required',
            '4' => 'required',
            '5' => 'required',
            '6' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '1.required' => 'NIK tidak boleh kosong',
            '1.unique' => 'NIK sudah terdaftar',
            '2.required' => 'Nama tidak boleh kosong',
            '3.required' => 'Jenis kelamin tidak boleh kosong',
            '4.required' => 'Tempat lahir tidak boleh kosong',
            '5.required' => 'Tanggal lahir tidak boleh kosong',
            '6.required' => 'Alamat tidak boleh kosong',
        ];
    }
}

// class AidRecipientImport implements ToCollection
// {
//     public function collection(Collection $rows)
//     {
//         dd($rows);
//     }
// }
