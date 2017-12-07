<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Carrinho</title>
	<meta name="description" content="Carrinho de compras">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<p><a href="index.php?route=index">Voltar</a></p>

	<?php if(!array_key_exists('carrinho',$_SESSION)): ?>
		<p><?php print 'Nenhum produto no carrinho. :( '; ?></p>
	<?php endif; ?>

	<?php if(array_key_exists('carrinho',$_SESSION) && array_key_exists('qtd',$_SESSION)): ?>
		
		<!-- exibição dos livros no carrinho -->
		<?php foreach($livros as $livro): ?>
				<a href="index.php?route=visualizar&id=<?php print $livro->getId(); ?>"><img src="imagens/<?php print $livro->getImagem(); ?>" alt="" ></a>

				<p><?php print $livro->getTitulo(); ?></p>

				<p>Quantidade: <?php print $_SESSION['qtd']["{$livro->getId()}"]; ?> </p>

				<p> Total:  <?php printf("R$ %.2f", $livro->getPreco() * $_SESSION['qtd']["{$livro->getId()}"]); ?> </p>

				<!-- formulário com remoção e adiçao -->
				<form method="POST">
					
					<input type="hidden" name="id" value="<?php print $livro->getId(); ?>">
				
					<p> Adicionar: <input type="number" name="quantidade" value="<?php print $_SESSION['qtd'][$livro->getId()]; ?>"></p>

					<p><input type="submit" name="adicionar" value="Adicionar"></p>

					<p><input type="submit" name="remover" value="Remover"></p>

					<?php $total += $livro->getPreco() * $_SESSION['qtd']["{$livro->getId()}"];?>

				</form>
			<?php endforeach; ?>
	<?php endif; ?>

	<!-- total do carrinho -->
	<?php if(array_key_exists('carrinho',$_SESSION) && array_key_exists('qtd',$_SESSION)): ?>
	
		<?php if(array_key_exists('carrinho', $_SESSION)) : ?>
				<p>Total: <?php printf("R$ %.2f",$total) ?></p>
		<?php endif; ?>
	<?php endif; ?>

</body>
</html>