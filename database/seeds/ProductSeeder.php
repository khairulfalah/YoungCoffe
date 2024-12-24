<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
        	'nama' => 'SUMATRA MANDHELING',
            'coffe_id' => 2,
            'gambar' => 'sumatra.png'
        ]);

        DB::table('products')->insert([
        	'nama' => 'JAVA ARABICA',
            'coffe_id' => 2,
            'gambar' => 'arabica.png'
        ]);

        DB::table('products')->insert([
        	'nama' => 'SULAWESI TORAJA',
            'coffe_id' => 2,
            'gambar' => 'toraja.png'
        ]);

        DB::table('products')->insert([
        	'nama' => 'BALI KINTAMANI',
            'coffe_id' => 2,
            'gambar' => 'bali.png'
        ]);

        DB::table('products')->insert([
        	'nama' => 'VIETNAMESE ROBUSTA',
            'coffe_id' => 1,
            'gambar' => 'vietnamrobusta.png'
        ]);

        DB::table('products')->insert([
        	'nama' => 'ARABICA DA LAT',
            'coffe_id' => 1,
            'gambar' => 'dalat.png'
        ]);

        DB::table('products')->insert([
        	'nama' => 'CATIMOR',
            'coffe_id' => 1,
            'gambar' => 'catimor.png'
        ]);

        DB::table('products')->insert([
        	'nama' => 'MONSOONED MALABAR',
            'coffe_id' => 4,
            'gambar' => 'malabar.png'
        ]);

        DB::table('products')->insert([
        	'nama' => 'MYSORE NUGGETS EXTRA BOLD',
            'coffe_id' => 4,
            'gambar' => 'mysore.png'
        ]);

        DB::table('products')->insert([
        	'nama' => 'ROBUSTA KAAPI ROYALE',
            'coffe_id' => 4,
            'gambar' => 'royal.png'
        ]);

        DB::table('products')->insert([
        	'nama' => 'KALINGA',
            'coffe_id' => 3,
            'gambar' => 'kalinga.png'
        ]);

        DB::table('products')->insert([
        	'nama' => 'LIBERICA BARAKO',
            'coffe_id' => 3,
            'gambar' => 'liberica.png'
        ]);
    }
}
