<?php
require_once 'helpers/php_ini_config.php';

session_start();

if(array_key_exists('carrinho', $_SESSION) && array_key_exists('qtd', $_SESSION)) {

	if($_SESSION['carrinho'] == null or is_null($_SESSION['qtd'] == null)) {
		session_destroy();

		session_start();
	}

}

$rota = 'index';

//print_r($_SESSION);

if(array_key_exists('route',$_GET)) {
	$rota = (string)$_GET['route'];

	require_once 'helpers/helpers.php';

	$rota = verificar_rota($rota);
}

if(is_file("controllers/{$rota}.php")) {

	require_once 'helpers/config.php';
	require_once 'helpers/banco.php';

	require "controllers/{$rota}.php";
}else {
	exit('Não foi possível encontrar essa rota. Volte a página.');
}