<?php

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
						print "<script>alert('Não foi possível encontrar o produto.');</script>";	
					}
				}else {
					print "<script>alert('Não foi possível encontrar o produto.');</script>";
				}

			}

		}

	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' && array_key_exists('adicionar',$_POST)) {

		if(array_key_exists('id',$_POST)) {

			$id = (int)$_POST['id'];

			if($id > 0 && filter_var($id, FILTER_VALIDATE_INT)) {

				$retorno = $repositorio_carrinho->verificarIdRetornoLogico($id);

				if($retorno) {

					if(array_key_exists('quantidade', $_POST)) {

						$quantidade = (int)$_POST['quantidade'];

						if($quantidade > 0) {

							if(array_key_exists('id',$_POST)) {
								
							}

						}else {
							print "<script>alert('Não foi possível encontrar o produto.');</script>";
						}

					}

				}else {
					print "<script>alert('Não foi possível encontrar o produto.');</script>";
				}

			}


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