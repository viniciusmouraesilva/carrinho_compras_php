<?php
//$id = (int)$_GET['id'] ?? '';

$id = array_key_exists('id',$_GET)?(int)$_GET['id']:'';

if($id > 0 && filter_var($id,FILTER_VALIDATE_INT)) {

	require_once __DIR__ .'/../models/livro.php';
	require_once __DIR__ .'/../models/repositorio_livros.php';

	$livro = new Livro();

	$repositorio_livros = new RepositorioLivros($pdo);

	$resu = $repositorio_livros->verificarId($id);

	if($resu == false) {
		header("Location:index.php");
		exit;
	}else {
		$livro = $resu;
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && array_key_exists('comprar',$_POST)) {
			
		if(array_key_exists('id',$_POST)) {
			
			$id = (int)$_POST['id'];
			
			if($id > 0 && filter_var($id, FILTER_SANITIZE_STRING)) {
				
				$resu = $repositorio_livros->verificarIdRetornoLogico($id);
				
				try {
					if($resu) {
						
						require_once 'helpers/helpers.php';
						
						if(!array_key_exists('carrinho',$_SESSION) && !array_key_exists('qtd',$_SESSION)) {
						
							$qtd_b = $repositorio_livros->devolverQuantidadeExistente($id);
						
							if($qtd_b > 0) {
								
								$_SESSION['carrinho']["{$id}"] = $id;
								$_SESSION['qtd']["{$id}"] = 1;
							
								header('Location:index.php?route=carrinho');
								exit;
								
							}else {
								header('Location:index.php');
								exit;	
							}
						}else {
			
							$novo = verificar_novo_produto($id);
							
							if($novo) {
								
								$qtd_b = $repositorio_livros->devolverQuantidadeExistente($id);
						
								if($qtd_b > 0) {
									
									$_SESSION['carrinho']["{$id}"] = $id;
									$_SESSION['qtd']["{$id}"] = 1;
							
									header('Location:index.php?route=carrinho');
									exit;
									
								}
								
							}else {
								
								$qtd_b = $repositorio_livros->devolverQuantidadeExistente($id);
								
								if(is_array($qtd_b)) {
										
									$qtd_b = $qtd_b['qtd'];	
										
									if($qtd_b > $_SESSION['qtd']["{$id}"]) {
									
										$_SESSION['qtd']["{$id}"] += 1;
									
										header('Location:index.php?route=carrinho');
										exit;
									
									}elseif($qtd_b == 0) {
									
										unset($_SESSION['carrinho']["{$id}"]);
										unset($_SESSION['qtd']["{$qtd}"]);
									
										header('Location:index.php');
										exit;
									
									}else {	
										header('Location:index.php?route=carrinho');
										exit;									
									}
								}
							}
						}
						
					}else {
						throw new Exception('Não foi possível encontrar o produto.');
					}
				}catch(Exception $ex) {
					print $ex->getMessage();
				}
			}
			
		}	
	}
	
}else {
	header("Location:index.php");
	exit;
}

require_once __DIR__ .'/../views/livro.php';