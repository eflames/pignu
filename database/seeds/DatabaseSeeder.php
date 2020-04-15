<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ConfigsTableSeeder::class);
        $this->call(CategoryTypesSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(OrderStatusTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(AppLanguageTableSeeder::class);
        $this->call(SeoTableSeeder::class);
    }
}
