<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Lojinha</title>
	<meta name="description" content="Lojinha de vendas">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<a href="index.php?route=carrinho">Carrinho</a>

	<?php if(array_key_exists('carrinho',$_SESSION) && array_key_exists('qtd',$_SESSION)): ?>
		<?php if($_SESSION['carrinho'] != null && $_SESSION['qtd'] != null): ?>
			<?php print sizeof($_SESSION['carrinho']);?>
		<?php else:  ?>
			<?php print '0'; ?>
		<?php endif ?>
	<?php else: ?>
		<?php print '0'; ?> 
	<?php endif; ?>

	<!-- Section Livros-->
	<section class="livros">

		<!-- Exibir livros -->
		<?php foreach($livros as $livro) : ?>

			<p><a href="index.php?route=visualizar&id=<?php print $livro->getId(); ?>"><img src="imagens/<?php print $livro->getImagem(); ?>" alt=""></a></p>
			
			<p><?php print $livro->getTitulo(); ?></p>
			<p><?php print $livro->getSubtitulo(); ?></p>
			<p>R$ <?php printf("%.2f",$livro->getPreco()); ?></p>

			<form method="POST">
				<input type="hidden" name="id" value="<?php print $livro->getId(); ?>">
				<input type="submit" value="Adicionar Carrinho">
			</form>
		<?php endforeach; ?>
	</section>
</body>
</html>