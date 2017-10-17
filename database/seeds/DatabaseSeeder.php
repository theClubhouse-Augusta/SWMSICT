<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(companiesTableSeeder::class);
        $this->call(productsTableSeeder::class);
        $this->call(packagesTableSeeder::class);
        $this->call(riskLevelsTableSeeder::class);
    }
}
