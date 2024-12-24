<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoffeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coffes')->insert([
        	'nama' => 'Kopi Vietnam',
        	'negara' => 'Vietnam',
        	'gambar' => 'vietnam.png',
        ]);

        DB::table('coffes')->insert([
        	'nama' => 'Kopi Indonesia',
        	'negara' => 'Indonesia',
        	'gambar' => 'indonesia.png',
        ]);

        DB::table('coffes')->insert([
        	'nama' => 'Kopi Filipina',
        	'negara' => 'India',
        	'gambar' => 'filipina.png',
        ]);

        DB::table('coffes')->insert([
        	'nama' => 'Kopi India',
        	'negara' => 'Filipina',
        	'gambar' => 'india.png',
        ]);
    }
}
