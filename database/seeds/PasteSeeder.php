<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'title' => 'Testing seeder #1',
            'code' => 'Some random code',
            'private' => null,
        ]);

        DB::table('pastes')->insert([

            'slug' => 'a1a1a1',
            'user' => 'Seeder',
            'language' => 'yaml',
            'title' => 'Testing seeder #2',
            'code' => 'Some random code',
            'private' => Hash::make('mypass'),
        ]);
    }
}
