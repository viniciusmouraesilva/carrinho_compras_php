<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Lojinha</title>
	<meta name="description" content="Lojinha de vendas">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/estilo.css">
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

	<h1>Pegue emprestado</h1>

	<!-- Section Livros-->
	<section class="area">

		<!-- Exibir livros -->
		<?php foreach($livros as $livro) : ?>

			<article class="item">
				<p><a href="index.php?route=visualizar&id=<?php print $livro->getId(); ?>"><img src="imagens/<?php print $livro->getImagem(); ?>" alt="" width="200" height="200" class="imagem"></a></p>

				<form method="POST" class="form">
					<input type="hidden" name="id" value="<?php print $livro->getId(); ?>">
					<p><input type="submit" value="Adicionar ao carrinho">	</p>
				</form>

				<p><?php print $livro->getTitulo(); ?></p>
				<p><?php print $livro->getSubtitulo(); ?></p>
				<p>R$ <?php print number_format($livro->getPreco(),2,',',0);  ?></p>

			</article>
		<?php endforeach; ?>	
	</section>
	<footer class="rodape">
		<p>&copy; Todos os direitos reservados a Pegue emprestado</p>
	</footer>
</body>
</html>