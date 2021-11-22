<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\niveldeusuario;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' =>'Administrador',
            'email' => 'adminrestaurante@restaurante-local.com',
            'password' => Hash::make('ResT@uranteLocal'),
            'id_nivel' => 1,
        ]);
        niveldeusuario::create([
            'name' =>'Administradores',
        ]);
        niveldeusuario::create([
            'name' =>'Mesonero',
        ]);
        niveldeusuario::create([
            'name' =>'Cajero',
        ]);
    }
}
