<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasteSeeder extends Seeder
{
    /**
     * Run the database seeds for the tests
     *
     * @return void
     */
    public function run()
    {
        DB::table('pastes')->insert([

            'slug' => 'a0a0a0',
            'user' => 'Seeder',
            'language' => 'yaml',
            'title' => 'Testing seeder',
            'code' => 'Some random code',
        ]);
    }
}
