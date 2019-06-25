<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Produto;
use App\Categoria;

Route::get('/', function () {
	return view('welcome');
});

Route::get('/categorias', function(){
	$categorias = Categoria::all();
	if (isset($categorias)){
		foreach ($categorias as $categoria) {	
			echo "ID: ".$categoria->id.'  Nome: '.$categoria->nome.'<br>';
		}
	}else echo "Nenhuma categoria";
});



Route::get('/produtos', function(){
	$produtos = Produto::all();
	if (isset($produtos)){
		foreach ($produtos as $produto) {	
			echo "ID: ".$produto->id.'  Nome: '.$produto->nome.
			' Preço: '.$produto->preco.' Estoque: '.$produto->estoque.
			' Categoria: '.$produto->categoria->nome.'<br>';
		}
	}else echo "Nenhum produto";
});

Route::get('/categoria_produtos', function(){
	$categorias = Categoria::all();
	if(isset($categorias)){
		foreach ($categorias as $categoria) {
			echo "_______________________________<br>";
			echo "ID: ".$categoria->id.'  Nome Categoria: '.$categoria->nome.'<br>';
			echo "Produtos desta categoria <br>";
			if (isset($categoria->produtos)) {
				foreach ($categoria->produtos as $produto) {
					echo "Nome do produto: ".$produto->nome.'<br>';
				}
				echo "_______________________________<br>";

			}else echo "Nenhum nesta categoria";
			
		}
	}
});

Route::get('/categoria_produtos', function(){
	$categorias = Categoria::all();
	if(isset($categorias)){
		foreach ($categorias as $categoria) {
			echo "_______________________________<br>";
			echo "ID: ".$categoria->id.'  Nome Categoria: '.$categoria->nome.'<br>';
			echo "Produtos desta categoria <br>";
			if (isset($categoria->produtos)) {
				foreach ($categoria->produtos as $produto) {
					echo "Nome do produto: ".$produto->nome.'<br>';
				}
				echo "_______________________________<br>";

			}else echo "Nenhum nesta categoria";
			
		}
	}
});

#recuperando json de produtos de uma determinada categoria
Route::get('/categoria_produtos_json', function(){
	$categorias = Categoria::with('produtos')->get();
	return json_encode($categorias);
});

#associando produto a categoria ao adicionar
Route::get('/adicionarproduto', function(){
	//categoria determinada
	$categoria = Categoria::find(2);
	$produto = new Produto();
	$produto->nome = "microondas";
	$produto->preco = 1000;
	$produto->estoque = 5;
	$produto->categoria()->associate($categoria);
	$produto->save();
	return json_encode($produto);
});
#desassociando 
Route::get('/remove_associac_produto_cat',function(){
	$produto = Produto::find(1);
	if (isset($produto)) {
		$produto->categoria()->dissociate();
		$produto->save();
		return json_encode($produto);
	}
	return '';
});

# adicionando categoria a um produto
Route::get('/adiciona_categoria/{cat}', function($cat){
	$categoria = Categoria::with('produtos')->find($cat);

	$produto = new Produto();
	$produto->nome = "Guarda roupa";
	$produto->preco = 400;
	$produto->estoque = 2;

	if (isset($categoria)) {
	$categoria->produtos()->save($produto);
	}
	$categoria->load('produtos');
	return json_encode($categoria);
});