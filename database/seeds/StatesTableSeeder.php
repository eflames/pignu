<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            ['name' => 'Amazonas'],
            ['name' => 'Anzoátegui'],
            ['name' => 'Apure'],
            ['name' => 'Aragua'],
            ['name' => 'Barinas'],
            ['name' => 'Bolí­var'],
            ['name' => 'Carabobo'],
            ['name' => 'Cojedes'],
            ['name' => 'Delta Amacuro'],
            ['name' => 'Falcón'],
            ['name' => 'Guárico'],
            ['name' => 'Lara'],
            ['name' => 'Mérida'],
            ['name' => 'Miranda'],
            ['name' => 'Monagas'],
            ['name' => 'Nueva Esparta'],
            ['name' => 'Portuguesa'],
            ['name' => 'Sucre'],
            ['name' => 'Táchira'],
            ['name' => 'Trujillo'],
            ['name' => 'Vargas'],
            ['name' => 'Yaracuy'],
            ['name' => 'Zulia'],
            ['name' => 'Distrito Capital'],
            ['name' => 'Dependencias Federales'],
        ]);
    }
}
