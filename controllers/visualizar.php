<?php
$id = (int)$_GET['id'] ?? '';

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
}else {
	header("Location:index.php");
	exit;
}

require_once __DIR__ .'/../views/livro.php';