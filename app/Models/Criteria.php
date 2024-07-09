<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'type', 'weight'];

    public function subCriterias()
    {
        return $this->hasMany(SubCriteria::class);
    }
}
