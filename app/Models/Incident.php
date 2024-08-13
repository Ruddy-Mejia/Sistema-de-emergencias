<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;
    protected $table = "incidents";
    protected $fillable = [
        'nature',
        'latitude',
        'longitude',
        'description',
        'type',
        'patient_id',
        'evidence',
        'details',
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
