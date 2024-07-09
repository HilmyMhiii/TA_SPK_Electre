<?php

namespace App\Http\Controllers;

use App\Models\ComparisonSubCriteria;
use App\Models\Criteria;
use App\Models\PatientCriteria;
use App\Models\SubCriteria;
use App\Models\Weight;
use Illuminate\Http\Request;

class SubCriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCriterias = SubCriteria::all();
        return view('admin.subcriterias.index', compact('subCriterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $criterias = Criteria::all();
        return view('admin.subcriterias.create', compact('criterias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'criteria_id' => 'required',
            'name' => 'required|unique:sub_criterias',
            'code' => 'required|unique:sub_criterias',
            'value' => 'required',
        ], [
            'criteria_id.required' => 'Kriteria harus diisi',
            'name.required' => 'Nama subkriteria harus diisi',
            'name.unique' => 'Nama subkriteria sudah digunakan',
            'code.required' => 'Kode subkriteria harus diisi',
            'code.unique' => 'Kode subkriteria sudah digunakan',
            'value.required' => 'Nilai subkriteria harus diisi',
        ]);

        try {
            $subcriteria = SubCriteria::create($request->all());
            return redirect()->route('subcriterias.index')->with('success', 'Subkriteria ' . $subcriteria->name . ' berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('subcriterias.index')->with('error', 'Subkriteria ' . $request->name . ' gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCriteria $subcriteria)
    {
        return view('admin.subcriterias.show', compact('subcriteria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCriteria $subcriteria)
    {
        $criterias = Criteria::all();
        return view('admin.subcriterias.edit', compact('subcriteria', 'criterias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCriteria $subcriteria)
    {
        $request->validate([
            'criteria_id' => 'required',
            'name' => 'required|unique:sub_criterias,name,' . $subcriteria->id,
            'code' => 'required|unique:sub_criterias,code,' . $subcriteria->id,
            'value' => 'required',
        ], [
            'criteria_id.required' => 'Kriteria harus diisi',
            'name.required' => 'Nama subkriteria harus diisi',
            'name.unique' => 'Nama subkriteria sudah digunakan',
            'code.required' => 'Kode subkriteria harus diisi',
            'code.unique' => 'Kode subkriteria sudah digunakan',
            'value.required' => 'Nilai subkriteria harus diisi',
        ]);

        try {
            $subcriteria->update($request->all());
            return redirect()->route('subcriterias.index')->with('success', 'Subkriteria ' . $subcriteria->name . ' berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('subcriterias.index')->with('error', 'Subkriteria ' . $subcriteria->name . ' gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCriteria $subcriteria)
    {
        try {
            $patientsCriteria = PatientCriteria::all();
            if ($patientsCriteria->count() > 0) {
                foreach ($patientsCriteria as $patientCriteria) {
                    $values = json_decode($patientCriteria->values);
                    foreach ($values as $key => $value) {
                        if ($value == $subcriteria->code) {
                            // unset($values->{$key});
                            //ambil kriteria yang memiliki subkriteria, dari ketiga data first
                            $criteria = Criteria::where('id', $subcriteria->criteria_id)->first();
                            $subcriterias = $criteria->subCriterias;
                            if ($subcriterias->count() > 0) {
                                //ganti subkriteria yang dihapus dengan subkriteria terakhir
                                $lastSubcriteria = $subcriterias->last();
                                $values->{$key} = $lastSubcriteria->code;
                                ComparisonSubCriteria::where('sub_criteria_id', $subcriteria->id)->update([
                                    'sub_criteria_id' => $lastSubcriteria->id,
                                    'value' => $lastSubcriteria->value,
                                ]);
                            } else {
                                return redirect()->route('subcriterias.index')->with('error', 'Subkriteria ' . $subcriteria->name . ' gagal dihapus, karena subkriteria ini adalah satu-satunya subkriteria dari kriteria ' . $criteria->name);
                            }
                        }
                    }
                    $patientCriteria->values = json_encode($values);
                    $patientCriteria->save();
                }
            }

            $name = $subcriteria->name;
            $subcriteria->delete();
            return redirect()->route('subcriterias.index')->with('success', 'Subkriteria ' . $name . ' berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('subcriterias.index')->with('error', 'Subkriteria ' . $subcriteria->name . ' gagal dihapus');
        }
    }
}
