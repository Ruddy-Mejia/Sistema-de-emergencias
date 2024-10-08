<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table = "roles";
    protected $fillable = [
        'name',
        'guard_name',
    ];


    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }
}
