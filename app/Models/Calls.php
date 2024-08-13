<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calls extends Model
{
    use HasFactory;
    protected $table = "calls";
    protected $fillable = [
        'code',
        'full_name',
        'address',
        'phone',
        'type_of_call',
        'description',
        'institution',
    ];
}
