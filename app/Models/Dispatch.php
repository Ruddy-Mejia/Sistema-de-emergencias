<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    use HasFactory;
    protected $table = "dispatch";
    protected $fillable = [
        'date',
        'ambulance_id',
        'latitude',
        'longitude',
        'code_autizacion',
    ];
    public function ambulance()
    {
        return $this->belongsTo(Ambulance::class, 'ambulance_id');
    }
}
