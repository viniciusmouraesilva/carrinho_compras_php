<?php
require_once 'helpers/php_ini_config.php';

session_start();

print_r($_SESSION);

$rota = 'index';

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