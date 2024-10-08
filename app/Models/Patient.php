<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = "patient";
    protected $fillable = [
        'name',
        'lastname',
        'address',
        'age',
        'phone',
        'phone_family',
    ];
}
