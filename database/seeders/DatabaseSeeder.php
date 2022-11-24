<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rols')->insert([
            'nombre'  => 'Administrador',
        ]);
        DB::table('rols')->insert([
            'nombre'  => 'Usuario',
        ]);

        DB::table('users')->insert([
            'name'  => 'admin',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('12345678'),
            'rol_id' => '1',
        ]);


    }
}
