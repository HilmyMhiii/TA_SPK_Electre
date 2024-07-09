<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComparisonSubCriteria extends Model
{
    use HasFactory;

    protected $fillable = ['criteria_id', 'sub_criteria_id', 'patient_id', 'value'];
}
