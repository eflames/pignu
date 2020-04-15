<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
            ['key' => 'company',                    'value' => 'Ernesto Flames',              'created_by' => 1,       'description' => 'Nombre de la empresa', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'address',                    'value' => '',                            'created_by' => 1,       'description' => 'Dirección de la empresa', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'email',                      'value' => '',                            'created_by' => 1,       'description' => 'Correo Electrónico', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'phone',                      'value' => '',                            'created_by' => 1,       'description' => 'Teléfono de contacto', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'facebook',                   'value' => '',                            'created_by' => 1,       'description' => 'Usuario de Facebook', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'twitter',                    'value' => '',                            'created_by' => 1,       'description' => 'Usuario de Twitter', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'instagram',                  'value' => '',                            'created_by' => 1,       'description' => 'Usuario de Intagram', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'developerEmail',             'value' => 'eflames@gmail.com',           'created_by' => 1,       'description' => 'Correo electrónico del desarrollador', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'default_image',              'value' => '',                            'created_by' => 1,       'description' => '(SEO) Image por defecto del sitio', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'multi_lang',                 'value' => '0',                           'created_by' => 1,       'description' => 'Activar o desactivar la capacidad multidiomas del sitio (1 ON, 0 OFF)', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'ga_client_id',               'value' => '',                            'created_by' => 1,       'description' => 'CLIENT_ID del API Google Analytics para métrica del sitio', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'ga_view_id',                 'value' => '',                            'created_by' => 1,       'description' => 'Google Analytics. Concatenación de nombres ga: + ID de vista (perfil)', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'ProductWidthImage',          'value' => '800',                         'created_by' => 1,       'description' => 'Tamaño ancho del crop en Productos', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'ProductHeightImage',         'value' => '600',                         'created_by' => 1,       'description' => 'Tamaño alto del crop en  Productos', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'itemsPerPage',               'value' => '10',                          'created_by' => 1,       'description' => 'Items mostrados en las listas del admin', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'maxImagesPerProduct',        'value' => '5',                           'created_by' => 1,       'description' => 'Cantidad máxima de imágenes por producto', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'maxImagesPerGallery',        'value' => '5',                           'created_by' => 1,       'description' => 'Cantidad máxima de imágenes por galería', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'articleWidthImage',           'value' => '800',                        'created_by' => 1,       'description' => 'Ancho de las imágenes en artículos', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'articleHeightImage',          'value' => '600',                        'created_by' => 1,       'description' => 'Ancho de las imágenes en artículos', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'galleryHeightImage',          'value' => '600',                        'created_by' => 1,       'description' => 'Alto de las imágenes en galerías', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'galleryWidthtImage',          'value' => '800',                        'created_by' => 1,       'description' => 'Ancho de las imágenes en galerías', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'galleryThumbHeightImage',     'value' => '320',                        'created_by' => 1,       'description' => 'Alto de las imágenes miniatura en galerías', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['key' => 'galleryThumbWidthImage',      'value' => '480',                        'created_by' => 1,       'description' => 'Ancho de las imágenes miniatura en galerías', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],

        ]);
    }
}
