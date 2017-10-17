<?php

use Illuminate\Database\Seeder;

class riskLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('riskLevels')->insert([
            'name' => 'Aggresive',
      ]);
      DB::table('riskLevels')->insert([
            'name' => 'Moderate',
      ]);
      DB::table('riskLevels')->insert([
            'name' => 'Conservative',
      ]);
    }
}
