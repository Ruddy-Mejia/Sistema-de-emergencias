<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UpdateUserPasswordsSeeder extends Seeder
{
    /**
     * Ejecuta las semillas de la base de datos.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function ($user) {
            $user->update([
                'password' => Hash::make('12345678')
            ]);
        });
    }
}
