<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientCriteria extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'values'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
