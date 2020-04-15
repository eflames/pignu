<?php

use Illuminate\Database\Seeder;
use App\Models\Seo;

class SeoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TODO: probar si el formulario automaticamente crea el español sin nada extra
        // TODO: si no lo hace, crear seeder para agregar el español por defecto en la tabla de lenguajes
        // TODO: y que el formulario tome automaticamente todos los idiomas agregados incluyendo el español
        Seo::create(['key' => 'home_title', 'value' => 'Título de la página']);
        Seo::create(['key' => 'home_description', 'value' => 'Descripción de la página']);

    }
}
