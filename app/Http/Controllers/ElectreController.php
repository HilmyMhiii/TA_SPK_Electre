<?php

namespace App\Http\Controllers;

use App\Models\ComparisonSubCriteria;
use App\Models\Criteria;
use App\Models\Patient;
use App\Models\PatientCriteria;
use Illuminate\Http\Request;

class ElectreController extends Controller
{
    public function electre()
    {
        $comparisonSubCriterias = ComparisonSubCriteria::all();
        $criterias = Criteria::all();
        $patientCriterias = PatientCriteria::all();
        $patients = Patient::all();
        return view('admin.electre.index', compact('comparisonSubCriterias', 'criterias', 'patientCriterias', 'patients'));
    }
}
