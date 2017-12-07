<?php
try {
	$pdo = new PDO(DSN,USUARIO,SENHA,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}catch(PDOException $ex) {
	print $ex->getMessage();
	exit('Não foi posível conectar com o banco de dados');
}