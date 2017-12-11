<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Carrinho</title>
	<meta name="description" content="Carrinho de compras">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/estilo_carrinho.css">
</head>
<body>
	<header class="menu">
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
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

	<?php if(array_key_exists('carrinho',$_SESSION) && array_key_exists('qtd',$_SESSION)): ?>
		
		<!-- exibição dos livros no carrinho -->
		<?php foreach($livros as $livro): ?>
				
				<table class="tabela">	
					<tr>
						<th>Produto</th>
						<th>Quantidade</th>
						<th>Total</th>
					</tr>

					<td>
						<a href="index.php?route=visualizar&id=<?php print $livro->getId(); ?>"><img src="imagens/<?php print $livro->getImagem(); ?>" width="100" height="70"alt="" ></a>

						<?php print $livro->getTitulo(); ?>
					</td>
					
					<td>
						
						<!-- formulário com remoção e adiçao -->
						<form method="POST" class="form">
						
							<input type="hidden" name="id" value="<?php print $livro->getId(); ?>">
				
							<p>Adicionar: <input type="number" name="quantidade" value="<?php print $_SESSION['qtd'][$livro->getId()]; ?>"></p>

							<p><input type="submit" name="adicionar" value="Adicionar"></p>

							<p><input type="submit" name="remover" value="Remover"></p>

							<?php $total += $livro->getPreco() * $_SESSION['qtd']["{$livro->getId()}"];?>
							
							<p>Quantidade: <?php print $_SESSION['qtd']["{$livro->getId()}"]; ?></p>

						</form>

					</td>
					
					<td>
						Total:  <?php print 'R$ '. number_format($livro->getPreco() * $_SESSION['qtd']["{$livro->getId()}"],2,',',0); ?>
					</td>
				
				</table>
				<br>
			<?php endforeach; ?>
	<?php endif; ?>

	<?php if(!array_key_exists('carrinho',$_SESSION) && !array_key_exists('qtd',$_SESSION)): ?>
		<section class="corpo">
			<p class="carrinho_vazio"><?php print 'Nenhum produto no carrinho. :( '; ?></p>
		</section>
	<?php endif; ?>

	<!-- total do carrinho -->
	<section class="total">
		<?php if(array_key_exists('carrinho',$_SESSION) && array_key_exists('qtd',$_SESSION)): ?>
			<?php if($_SESSION['carrinho'] != null && $_SESSION['qtd'] != null): ?>
				<?php if(array_key_exists('carrinho', $_SESSION)) : ?>
					<p class="total">Total: <?php print 'R$ '. number_format($total,2,',',0) ?></p>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
	</section>

	<footer class="rodape">
		<p>&copy; Todos os direitos reservados a Pegue emprestado</p>
	</footer>
</body>
</html>