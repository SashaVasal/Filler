<?php

use Illuminate\Database\Seeder;

class Begin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('players')->insert([
            'color' => 'blue'
        ]);
        DB::table('players')->insert([
            'color' => 'blue'
        ]);
    }
}
