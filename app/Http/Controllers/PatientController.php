<?php

namespace App\Http\Controllers;

use App\Imports\PatientImport;
use App\Models\ComparisonSubCriteria;
use App\Models\Criteria;
use App\Models\Patient;
use App\Models\PatientCriteria;
use App\Models\SubCriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();
        return view('admin.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $criterias = Criteria::all();
        return view('admin.patients.create', compact('criterias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nik' => 'required|unique:patients',
            'gender' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'address' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => 'Nama pasien harus diisi',
            'nik.required' => 'NIK pasien harus diisi',
            'nik.unique' => 'NIK pasien sudah terdaftar',
            'gender.required' => 'Jenis kelamin pasien harus diisi',
            'place_of_birth.required' => 'Tempat lahir pasien harus diisi',
            'date_of_birth.required' => 'Tanggal lahir pasien harus diisi',
            'address.required' => 'Alamat pasien harus diisi',
            'photo.image' => 'Foto harus berupa gambar',
            'photo.mimes' => 'Foto harus berformat jpeg, png, jpg, gif, atau svg',
            'photo.max' => 'Ukuran foto maksimal 2MB',
        ]);

        //buat validasi dinamis sesuai inputan yang masuk
        $values = [];
        foreach ($request->except(['_token', '_method', 'patient_id']) as $key => $value) {
            if ($key === "name" || $key === "nik" || $key === "gender" || $key === "place_of_birth" || $key === "date_of_birth" || $key === "address" || $key === "photo") {
                continue;
            } else {
                $request->validate([$key => 'required'], ['required' => 'Kriteria ' . $key . ' harus diisi']);
                $values[$key] = $value;
            }
        }

        $photo = null;
        if ($request->hasFile('photo')) {
            $PhotoName = time() . '.' . $request->photo->extension();
            $path = $request->file('photo')->storeAs('patients', $PhotoName, 'public');
            $photo = $path;
        }

        try {
            $patient = Patient::create([
                'name' => $request->name,
                'nik' => $request->nik,
                'gender' => $request->gender,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'address' => $request->address,
                'photo' => $photo ?? null,
            ]);

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

            return redirect()->route('patients.index')->with('success', 'Pasien ' . $patient->name . ' berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('patients.index')->with('error', 'Pasien ' . $request->name . ' gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        $criterias = Criteria::all();
        $patientCriteria = PatientCriteria::where('patient_id', $patient->id)->first();
        $criteriaPatient = json_decode($patientCriteria->values);
        return view('admin.patients.show', compact('patient', 'criterias', 'patientCriteria', 'criteriaPatient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        $criterias = Criteria::all();
        $patientCriteria = PatientCriteria::where('patient_id', $patient->id)->first();
        $criteriaPatient = json_decode($patientCriteria->values);
        return view('admin.patients.edit', compact('patient', 'criterias', 'patientCriteria', 'criteriaPatient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required',
            'nik' => 'required|unique:patients,nik,' . $patient->id,
            'gender' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'address' => 'required',
            'photo_new' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => 'Nama pasien harus diisi',
            'nik.required' => 'NIK pasien harus diisi',
            'nik.unique' => 'NIK pasien sudah terdaftar',
            'gender.required' => 'Jenis kelamin pasien harus diisi',
            'place_of_birth.required' => 'Tempat lahir pasien harus diisi',
            'date_of_birth.required' => 'Tanggal lahir pasien harus diisi',
            'address.required' => 'Alamat pasien harus diisi',
            'photo_new.image' => 'Foto harus berupa gambar',
            'photo_new.mimes' => 'Foto harus berformat jpeg, png, jpg, gif, atau svg',
            'photo_new.max' => 'Ukuran foto maksimal 2MB',
        ]);

        $values = [];
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            if ($key === "name" || $key === "nik" || $key === "gender" || $key === "place_of_birth" || $key === "date_of_birth" || $key === "address" || $key === "photo") {
                continue;
            } else {
                $request->validate([$key => 'required'], ['required' => 'Kriteria ' . $key . ' harus diisi']);
                $values[$key] = $value;
            }
        }

        $photo = $patient->photo;
        if ($request->hasFile('photo_new')) {
            if ($patient->photo !== null) {
                unlink(storage_path('app/public/patients/' . $patient->photo));
            }
            $PhotoName = time() . '.' . $request->photo_new->extension();
            $path = $request->file('photo_new')->storeAs('patients', $PhotoName, 'public');
            $photo = $path;
        }

        try {
            $patient->update([
                'name' => $request->name,
                'nik' => $request->nik,
                'gender' => $request->gender,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'address' => $request->address,
                'photo' => $photo ?? null,
            ]);

            $patientCriteriaOld = PatientCriteria::where('patient_id', $patient->id)->first();
            $valuesOld = json_decode($patientCriteriaOld->values);
            $valuesArray = (array) $valuesOld;

            foreach ($values as $key => $value) {
                $subCriteriaOld = SubCriteria::where('code', $valuesArray[$key])->first();
                $subCriteria = SubCriteria::where('code', $value)->first();
                $comparisonSubCriteria = ComparisonSubCriteria::where('patient_id', $patient->id)->where('criteria_id', $subCriteriaOld->criteria->id)->where('sub_criteria_id', $subCriteriaOld->id)->first();
                if ($comparisonSubCriteria) {
                    $comparisonSubCriteria->criteria_id = $subCriteria->criteria->id;
                    $comparisonSubCriteria->sub_criteria_id = $subCriteria->id;
                    $comparisonSubCriteria->value = $subCriteria->value;
                    $comparisonSubCriteria->patient_id = $patient->id;
                    $comparisonSubCriteria->save();
                } else {
                    return redirect()->route('patients.index')->with('error', 'Data kriteria pasien gagal diperbarui');
                }
            }

            $patientCriteria = PatientCriteria::where('patient_id', $patient->id)->first();
            $patientCriteria->values = json_encode($values);
            $patientCriteria->save();

            return redirect()->route('patients.index')->with('success', 'Pasien ' . $patient->name . ' berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('patients.index')->with('error', 'Pasien ' . $patient->name . ' gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        try {
            $name = $patient->name;
            //cek apakah ada foto
            if ($patient->photo !== null && file_exists(storage_path('app/public/' . $patient->photo))) {
                unlink(storage_path('app/public/' . $patient->photo));
            }

            $patientCriteria = PatientCriteria::where('patient_id', $patient->id)->first();
            ComparisonSubCriteria::where('patient_id', $patientCriteria->id)->delete();
            $patientCriteria->delete();
            $patient->delete();
            return redirect()->route('patients.index')->with('success', 'Pasien ' . $name . ' berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('patients.index')->with('error', 'Pasien ' . $patient->name . ' gagal dihapus');
        }
    }

    public function createExcel()
    {
        return view('admin.patients.create_excel');
    }

    public function storeExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $request->file('file');
        //import data
        Excel::import(new PatientImport, $file);

        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil diimport');
    }
}
