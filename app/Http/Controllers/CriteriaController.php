<?php

namespace App\Http\Controllers;

use App\Models\ComparisonSubCriteria;
use App\Models\Criteria;
use App\Models\PatientCriteria;
use App\Models\SubCriteria;
use App\Models\Weight;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $criterias = Criteria::all();
        return view('admin.criterias.index', compact('criterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.criterias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:criterias',
            'type' => 'required',
            'weight' => 'required',
            'name_subcriteria' => 'required',
            'value_subcriteria' => 'required',
            'code_subcriteria' => 'required|unique:sub_criterias,code',
        ], [
            'name.required' => 'Nama kriteria harus diisi',
            'code.required' => 'Kode kriteria harus diisi',
            'code.unique' => 'Kode kriteria sudah digunakan',
            'type.required' => 'Tipe kriteria harus diisi',
            'weight.required' => 'Bobot kriteria harus diisi',
            'name_subcriteria.required' => 'Nama subkriteria harus diisi',
            'value_subcriteria.required' => 'Nilai subkriteria harus diisi',
            'code_subcriteria.required' => 'Kode subkriteria harus diisi',
            'code_subcriteria.unique' => 'Kode subkriteria sudah digunakan',
        ]);

        try {
            $criteria = Criteria::create([
                'name' => $request->name,
                'code' => $request->code,
                'type' => $request->type,
                'weight' => $request->weight,
            ]);
            $subCriteria = SubCriteria::create([
                'criteria_id' => $criteria->id,
                'name' => $request->name_subcriteria,
                'value' => $request->value_subcriteria,
                'code' => $request->code_subcriteria,
            ]);

            $patientsCriteria = PatientCriteria::all();
            if ($patientsCriteria->count() > 0) {
                foreach ($patientsCriteria as $patientCriteria) {
                    $values = json_decode($patientCriteria->values);
                    $values->{$criteria->code} = $subCriteria->code;
                    $patientCriteria->values = json_encode($values);
                    $patientCriteria->save();
                }
            }

            foreach ($patientsCriteria as $patientCriteria) {
                $comparisonSubCriteria = new ComparisonSubCriteria();
                $comparisonSubCriteria->criteria_id = $criteria->id;
                $comparisonSubCriteria->sub_criteria_id = $subCriteria->id;
                $comparisonSubCriteria->patient_id = $patientCriteria->patient->id;
                $comparisonSubCriteria->value = $subCriteria->value;
                $comparisonSubCriteria->save();
            }

            return redirect()->route('criterias.index')->with('success', 'Kriteria ' . $criteria->name . ' berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('criterias.index')->with('error', 'Kriteria ' . $request->name . ' gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Criteria $criteria)
    {
        return view('admin.criterias.show', compact('criteria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Criteria $criteria)
    {
        return view('admin.criterias.edit', compact('criteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Criteria $criteria)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:criterias,code,' . $criteria->id,
            'type' => 'required',
            'weight' => 'required',
        ], [
            'name.required' => 'Nama kriteria harus diisi',
            'code.required' => 'Kode kriteria harus diisi',
            'code.unique' => 'Kode kriteria sudah digunakan',
            'type.required' => 'Tipe kriteria harus diisi',
            'weight.required' => 'Bobot kriteria harus diisi',
        ]);

        try {
            $code_old = $criteria->getOriginal('code');
            $criteria->update($request->all());

            // Dapatkan semua data patientsCriteria
            $patientsCriteria = PatientCriteria::all();

            // Loop melalui semua data patientsCriteria
            foreach ($patientsCriteria as $patientCriteria) {
                // Dekode nilai-nilai JSON
                $values = json_decode($patientCriteria->values, true);
                // Periksa apakah kriteria yang diubah ada dalam data patientsCriteria
                if (isset($values[$code_old])) {
                    // Simpan nilai yang akan diganti kunci
                    $value = $values[$code_old];
                    // Hapus kunci lama dan tambahkan kunci baru
                    unset($values[$code_old]);
                    $values[$criteria->code] = $value;
                    // Simpan kembali nilai-nilai dalam bentuk JSON
                    $patientCriteria->values = json_encode($values);
                    $patientCriteria->save();
                }
            }

            return redirect()->route('criterias.index')->with('success', 'Kriteria ' . $criteria->name . ' berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('criterias.index')->with('error', 'Kriteria ' . $criteria->name . ' gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Criteria $criteria)
    {
        try {
            $patientsCriteria = PatientCriteria::all();
            if ($patientsCriteria->count() > 0) {
                foreach ($patientsCriteria as $patientCriteria) {
                    $values = json_decode($patientCriteria->values);
                    foreach ($values as $key => $value) {
                        if ($key == $criteria->code) {
                            unset($values->{$key});
                        }
                    }
                    $patientCriteria->values = json_encode($values);
                    $patientCriteria->save();
                }
            }

            // hapus semua Comparison yang memiliki criteria_id
            ComparisonSubCriteria::where('criteria_id', $criteria->id)->delete();

            $name = $criteria->name;
            $criteria->delete();
            return redirect()->route('criterias.index')->with('success', 'Kriteria ' . $name . ' berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('criterias.index')->with('error', 'Kriteria ' . $criteria->name . ' gagal dihapus');
        }
    }
}
