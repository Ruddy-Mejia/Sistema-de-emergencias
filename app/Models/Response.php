<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;
    protected $table = "response";
    protected $fillable = [
        'response',
        'type',
        'level',
        'patient_id',
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
