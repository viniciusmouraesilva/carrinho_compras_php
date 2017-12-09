<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Livro</title>
	<meta charset="UTF-8">
	<meta name="description" content="Livro">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<a href="index.php?route=index">Voltar</a>
	<section class="livro">

		<p><img src="imagens/<?php print $livro->getImagem(); ?>" alt=""></p>

			<p><?php print $livro->getTitulo(); ?></p>
			<p><?php print $livro->getSubtitulo(); ?></p>
			<p>R$ <?php printf("%.2f",$livro->getPreco()); ?></p>
			
			<form method="POST">
				<input type="hidden" name="id" value="<?php print $livro->getId(); ?>">
				<input type="submit" name="comprar" value="Comprar">
			</form>
			
	</section>
</body>
</html>