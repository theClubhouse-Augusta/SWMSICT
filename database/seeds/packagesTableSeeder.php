<?php

use Illuminate\Database\Seeder;

class packagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('packages')->insert([
            'name' => 'Stocks',
      ]);
      DB::table('packages')->insert([
            'name' => 'Bonds',
      ]);
      DB::table('packages')->insert([
            'name' => 'Mutual funds',
      ]);
      DB::table('packages')->insert([
            'name' => 'Ex Trade funds',
      ]);
      DB::table('packages')->insert([
            'name' => 'Index funds',
      ]);
      DB::table('packages')->insert([
            'name' => 'Retirement',
      ]);
    }
}
