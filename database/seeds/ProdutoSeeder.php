<?php

use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	DB::table('produtos')->insert(['nome'=> 'Camisa polo', 'estoque' => 4 , 'preco' => 120, 'categoria_id' => 1]);

    	DB::table('produtos')->insert(['nome' => 'Mouse',
    		'preco' => 40 , 'estoque' => 12, 'categoria_id' => 2]);

    	DB::table('produtos')->insert(['nome' => 'edredom', 
    		'preco' => 60 , 'estoque' => 5, 'categoria_id' => 5]);

    	DB::table('produtos')->insert(['nome' => 'Fardo de coca cola', 
    		'preco' => 50 , 'estoque' => 89, 'categoria_id' => 6]);

    	DB::table('produtos')->insert(['nome' => 'Perfume 212', 
    		'preco' => 220 , 'estoque' => 14, 'categoria_id' => 3]);

    	DB::table('produtos')->insert(['nome' => 'sofa', 
    		'preco' => 420 , 'estoque' => 3, 'categoria_id' => 4]);
    }
}
