<?php
/* mensagm para quantidade inválida */

$mensagem = '';

if(array_key_exists('carrinho',$_SESSION) && array_key_exists('qtd',$_SESSION)) {

require_once __DIR__ .'/../models/repositorio_carrinho.php';
require_once __DIR__ .'/../models/livro.php';
require_once __DIR__ .'/../helpers/helpers.php';

$total = 0;

$livros = new Livro();

$repositorio_carrinho = new RepositorioCarrinho($pdo);

$qtd = 0;

$i = 0;

# Buscar quantidades
# e verificar alguma irregularidade no carrinho
foreach($_SESSION['carrinho'] as $id) {
	$qtd = $repositorio_carrinho->devolverQuantidadeExistente($id);

	if(is_array($qtd)) {
		$q = (int)$qtd['qtd'];
	}

	$retorno = verificar_qtd_carrinho_inicio($id, $q);

	if($retorno == false) {
		$i++;
	}
}

if($i > 0) {
	print "<script>alert('Alguns produtos foram alterados');</script>";
} 

$livros_busca = [];

//buscar livros para exibir no carrinho
foreach($_SESSION['carrinho'] as $id) {
	$livros_busca[] = $repositorio_carrinho->verificarId($id);
}

$livros = $livros_busca;

if($_SERVER['REQUEST_METHOD'] == 'POST' && array_key_exists('remover',$_POST)) {

	try { 

		if(array_key_exists('id',$_POST)) {

			$id = (int)$_POST['id'];

			if($id > 0 && filter_var($id, FILTER_VALIDATE_INT)) {

				$retorno = $repositorio_carrinho->verificarIdRetornoLogico($id);

				if($retorno) {
					$resposta = remover_item_carrinho($id);

					if($resposta) {
						header("Location:index.php?route=carrinho");
						exit;
					}else {
						throw new Exception('Não foi possível encontrar o produto.');	
					}
				}else {
					 throw new Exception('Não foi possível encontrar o produto.');
				}

			}

		}

	}catch(Exception $ex) {
		print $ex->getMessage();
	}

}

if($_SERVER['REQUEST_METHOD'] == 'POST' && array_key_exists('adicionar',$_POST)) {

	try {

		if(array_key_exists('id',$_POST)) {

			$id = (int)$_POST['id'];

			if($id > 0 && filter_var($id, FILTER_VALIDATE_INT)) {

				$retorno = $repositorio_carrinho->verificarIdRetornoLogico($id);

				if($retorno) {

					if(array_key_exists('quantidade', $_POST)) {

						$quantidade = (int)$_POST['quantidade'];

						if($quantidade > 0 && filter_var($quantidade,FILTER_VALIDATE_INT)) {
									
							// se existe no carrinho 
							$existe = verificar_novo_produto($id);

							if($existe == false) {

								$qtd_banco = $repositorio_carrinho->devolverQuantidadeExistente($id);
									
								$validacao = false;
									
								if(is_array($qtd_banco)) {
									$qtd_b = $qtd_banco['qtd'];
									$validacao = verificar_qtd_digitada($qtd_b, $id, $quantidade);
								}
								
								//verificar modificação da 
								//quantidade do produto
								if($validacao) {
									header('Location:index.php?route=carrinho');
									exit();
								}else {

									throw new Exception ('Não foi possível adicionar essa quantidade!');

								}

							}else {

								throw new Exception ('Não foi possível encontrar o produto.');

							}

						}else {
							throw new Exception('Informe uma quantidade válida para o produto.');
						}

					}

				}else {
					throw new Exception('Não foi possível encontrar o produto.');
				}

			}

		}
	}catch(Exception $ex) {
		$mensagem = $ex->getMessage();
	}

}

}else {
	
	if(array_key_exists('carrinho',$_SESSION)) {
		unset($_SESSION['carrinho']);
	}

	if(array_key_exists('qtd',$_SESSION)) {
		unset($_SESSION['qtd']);
	}

}

require_once __DIR__ .'/../views/carrinho.php';