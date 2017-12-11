<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Livro</title>
	<meta charset="UTF-8">
	<meta name="description" content="Livro">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/estilo_livro.css">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
</head>
<body>
	<header class="menu">
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="#">Tecnologia</a></li>
				<li><a href="#">Mángas</li></a></li>
				<li><a href="#">Auto Ajuda</a></li>
				<li><a href="index.php?route=carrinho">Carrinho</a>&nbsp;<span class="qtd_carrinho">

				<!-- número de produtos no carrinho -->

				<?php if(array_key_exists('carrinho',$_SESSION) && array_key_exists('qtd',$_SESSION)): ?>

					<?php if($_SESSION['carrinho'] != null && $_SESSION['qtd'] != null): ?>
						<?php print sizeof($_SESSION['carrinho']);?>
					<?php else:  ?>
						<?php print '0'; ?>
					<?php endif; ?>
				<?php else: ?>
					<?php print '0'; ?> 
				<?php endif; ?></span></li>
				<li><a href="#">Login</a></li>
			</ul>
		</nav>
	</header>

	<section class="livro">
		<h1><?php print $livro->getTitulo(); ?></h1>
	
		<img src="imagens/<?php print $livro->getImagem(); ?>" alt="" class="imagem">

			<form method="POST" class="form">
				<input type="hidden" name="id" value="<?php print $livro->getId(); ?>">
				<input type="submit" name="comprar" value="Comprar">
			</form>

			<h2>Descrição do Livro <?php print $livro->getTitulo(); ?></h2>
			<p class="descricao"><?php print $livro->getDescricao(); ?></p>

			<table class="livro_tabela">

				<tr>

					<td>Título</td>
					<td><?php print $livro->getTitulo(); ?></td>
					
				</tr>

				<tr>
					<td>Subtítulo</td>
					<td><?php print $livro->getSubtitulo(); ?></td>
					
				<tr>
					<td>Preço</td>
					<td>R$ <?php print number_format($livro->getPreco(),2,',',0); ?></td>
			
				</tr>

				<tr>
					<td>Autor</td>
			<td><?php print $livro->getAutor(); ?></td>
			
				</tr>

				<tr>
					<td>Número de Páginas</td>
					<td><?php print $livro->getNumeroPaginas(); ?></td>
				</tr>

				<tr>
					<td>Editora</td>
					<td><?php print $livro->getEditora(); ?></td>
				</tr>
			</table>
	</section>
	<footer class="rodape">
		<p>&copy; Todos os direitos reservados a Pegue emprestado</p>
	</footer>
</body>
</html>