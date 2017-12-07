<?php
#rotas url válidas 
function verificar_rota($rota) {

	switch($rota) {
		case 'carrinho':
			$rota = 'carrinho';
			break;
		case 'visualizar':
			$rota = 'visualizar';
			break;
		default:
			$rota = 'index';
			break;
	}

	return $rota;
}

function verificar_novo_produto($id) {

	$i = 0;

	foreach($_SESSION['carrinho'] as $id_carrinho) {

		if($id == $id_carrinho) {
			$i++;
		}
	}

	# se for igual a um é por que existe produto com id igual
	if($i == 1) {
		return false;
	}else {
		return true;
	}
}

#verificação a cada nova inserção de quantidade
function verificar_para_atualizar_quantidade($qtd_total_atual_banco, $id) {

	// se for 0 a quantidade deve ser removido do carrinho
	if($qtd_total_atual_banco <= 0) {
		unset($_SESSION['carrinho']["{$id}"]);
		unset($_SESSION['qtd']["{$id}"]);
		return false;
	}

	$qtd_em_session = $_SESSION['qtd']["{$id}"];

	# agora se for menor mas não for zero 
	# o prouto fica com a quantidade do banco 
	if($qtd_total_atual_banco < $qtd_em_session) {

		$diferenca = $qtd_total_atual_banco - $qtd_em_session;

		// se a difirenca for menor ou igual a zero 
		// a quantidade do produto fica com o total
		// ecncontrado no banco

		if($diferenca <= 0) {
			$_SESSION['qtd']["{$id}"] = $qtd_total_atual_banco;
			return false;
		}

	}elseif($qtd_total_atual_banco == $qtd_em_session) {
		// se quantidade igual nada é feito
		return false;

	}else {
		// se tiver a quantidade possível para
		// adcionar é feti o o aumento

		$_SESSION['qtd']["{$id}"] += 1;
		return true;
	}

}

# exclusão do produto no carrinho
# caso após consulta esteja zerado no banco
function excluir_do_carrinho_produto_zerado($id) {
	unset($_SESSION['carrinho']["{$id}"]);
	unset($_SESSION['qtd']["{$id}"]);		
}

function verificar_qtd_carrinho_inicio($id, $qtd_banco) {

	if($qtd_banco <= 0) {
		unset($_SESSION['carrinho']["{$id}"]);
		unset($_SESSION['qtd']["{$id}"]);
		return false;
	}

	$qtd_em_sessao = (int)$_SESSION['qtd']["{$id}"];

	if($qtd_banco < $qtd_em_sessao) {

		$diferenca = $qtd_banco - $qtd_em_sessao;

		if($diferenca <= 0) {

			$_SESSION['qtd']["{$id}"] = $qtd_banco;
			return false;
		}
	}else {
		return true;
	}

}

function remover_item_carrinho($id) {

	// fazer verificação se id costa na sessão também
	$resu = verificar_novo_produto($id);

	// false porque a função verificar é ligado
	// a adição de novos produtos veja no inicio

	if($resu == false) {
		unset($_SESSION['carrinho']["{$id}"]);
		unset($_SESSION['qtd']["{$id}"]);
		return true;
	}else {
		return false;
	}

}
