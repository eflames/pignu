<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Administrador',  'admin' => 1,      'p_blog' => 1,      'p_products' => 1,     'p_galleries' => 1,       'p_pages' => 1,           'p_categories' => 1,       'p_users' => 1,       'p_configs' => 1,       'p_log' => 1,        'created_by' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Editor',         'admin' => 1,      'p_blog' => 1,      'p_products' => 1,     'p_galleries' => 1,       'p_pages' => NULL,        'p_categories' => NULL,    'p_users' => NULL,    'p_configs' => NULL,    'p_log' => NULL,     'created_by' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Cliente',        'admin' => NULL,   'p_blog' => NULL,    'p_products' => NULL,  'p_galleries' => NULL,   'p_pages' => NULL,        'p_categories' => NULL,    'p_users' => NULL,    'p_configs' => NULL,    'p_log' => NULL,     'created_by' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ]);
    }
}