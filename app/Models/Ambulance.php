<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    use HasFactory;
    protected $table = "ambulance";
    protected $fillable = [
        'number_plate',
        'color',
        'model',
        'code',
        'conductor_id',
    ];
    public function conductor()
    {
        return $this->belongsTo(Conductor::class, 'conductor_id');
    }
}
