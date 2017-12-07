<?php
require_once __DIR__ .'/../models/livro.php';
require_once __DIR__ .'/../models/repositorio_livros.php';

$livros = new Livro();

$repositorio_livros = new RepositorioLivros($pdo);

$livros = $repositorio_livros->buscarProdutos();

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	require_once __DIR__ .'/../helpers/helpers.php';

	if(array_key_exists('id',$_POST)) {

		$id = (int)$_POST['id'];

	}

	$resu = false;

	if($id > 0 && filter_var($id, FILTER_VALIDATE_INT)) {
		$resu = $repositorio_livros->buscarProdutoCarrinho($id);
	}

	if($resu == false) {

		#Como o metódo buscarProdutoCarrinho acima
		#busca somente produtos com qtd > 0 é preciso
		#verificar se após a solicitação de adicionar ao
		#carrinho um produto esta zerado no banco e exclui-ló 
		#do carrinho 

		$id_valido = false;

		$id_valido = $repositorio_livros->verificarIdRetornoLogico($id);

		if($id_valido) {
			$qtd = $repositorio_livros->devolverQuantidadeExistente($id);

			if(is_array($qtd)) {
				$qtd = $qtd['qtd'];
			}

			if($qtd <= 0) {
				$ja_esta_carrinho = verificar_novo_produto($id);
			
				if($ja_esta_carrinho == false) {
					excluir_do_carrinho_produto_zerado($id);
					print "<script>alert('Esse produto foi excluído do seu carrinho.');</script>";
				}else {
					header("Location:index.php");
					exit;
				}
			}
		}else {
			header("Location:index.php");
			exit;
		}
	}else {

		/* adicionando livro ao carrinho. Só para o primeiro produto */
		if(!array_key_exists('carrinho',$_SESSION)) {
			
			$_SESSION['carrinho']["{$resu['id']}"] = $resu['id'];
			$_SESSION['qtd']["{$resu['id']}"] = 1;
			
			print "<script>alert('Produto adicionado ao carrinho!');</script>";
		}else {

			$novo_produto = verificar_novo_produto($resu['id']);

			#Se for um novo produto é adiconado.
			#Caso já exista esse produto. É feito a tentativa de 
			#aumentar a quantidade passando por verificações

			if($novo_produto) {
				$_SESSION['carrinho']["{$resu['id']}"] = $resu['id'];
				$_SESSION['qtd']["{$resu['id']}"] = 1;
			
				print "<script>alert('Produto adicionado ao carrinho');</script>";
			}else { 

				#Verificar se na quantidade atual + 1 
				#através da verificação no banco se é possível
				#adicionar a quantidade.

				$aumento = $_SESSION['qtd']["{$resu['id']}"] + 1;

				$aumentarQtd = $repositorio_livros->verificarAumentoQuantidade($_SESSION['carrinho']["{$resu['id']}"], $aumento);

				if($aumentarQtd) {

					#se possível vai aumentar a quantidade
					$_SESSION['qtd']["{$resu['id']}"] += 1;
					print "<script>alert('Produto adicionado ao carrinho.');</script>";

				}else {

					#atualizar a quantidade
					#atual mas também a mensagem referência
					#para o if acima de que não foi possível
					#adicionar a quantidade.

					$quantidade_existente = $repositorio_livros->devolverQuantidadeExistente($_SESSION['carrinho']["{$resu['id']}"]);

					if(is_array($quantidade_existente)) {
						$quantidade_existente = $quantidade_existente['qtd'];
					}

					$resultado = verificar_para_atualizar_quantidade($quantidade_existente, $resu['id']);

					if($resultado) {
						print "<script>alert('A quantidade do produto foi alterada!');</script>";
					}else {
						print "<script>alert('Não foi possível alterar a quantidade do Produto.');</script>";
					}
				}

			}
		}
	}

}

require_once __DIR__ .'/../views/template_index.php';