<?php 

class RepositorioLivros {

	private $pdo;

	public function __construct($pdo) {
		$this->pdo = $pdo;
	}

	public function buscarProdutos() {

		$sql = "SELECT * FROM livros WHERE qtd > 0";

		$query = $this->pdo->prepare($sql);

		$query->execute();

		$livros = [];

		while($livro = $query->FetchObject('Livro')) {
			$livros[] = $livro;
		} 

		return $livros;
	}

	public function verificarId($id) {

		try {

			$sql = "SELECT * FROM livros WHERE id = :id LIMIT 1";

			$query = $this->pdo->prepare($sql);

			$query->bindValue(':id',$id, PDO::PARAM_INT);

			$query->execute();
		
			$erros = $query->errorInfo();

			if($erros[0] != 00000) {
				throw new Exception();
			}

			return $query->FetchObject('Livro');
		}catch(Exception $ex) {
			return false;
		}
	}

	public function verificarIdRetornoLogico($id) {

		try {

			$sql = "SELECT * FROM livros WHERE id = :id LIMIT 1";

			$query = $this->pdo->prepare($sql);

			$query->bindValue(':id',$id, PDO::PARAM_INT);

			$query->execute();
		
			$erros = $query->errorInfo();

			if($erros[0] != 00000) {
				throw new Exception();
			}

			if($query->rowCount() == 1) {
				return true;
			}else {
				throw new Exception();
			}

		}catch(Exception $ex) {
			return false;
		}
	}

	public function buscarProdutoCarrinho($id) {

		try {

			$sql = "SELECT id, qtd FROM livros WHERE :id = id AND qtd > 0 LIMIT 1";

			$query = $this->pdo->prepare($sql);

			$query->bindValue(':id',$id, PDO::PARAM_INT);

			$query->execute();
		
			$erros = $query->errorInfo();

			if($erros[0] != 00000) {
				throw new Exception();
			}

			if($query->rowCount() == 1) {
				return $query->fetch(PDO::FETCH_ASSOC);
			}else {
				throw new Exception();
			}

			
		}catch(Exception $ex) {
			return false;
		}
	}

	public function verificarAumentoQuantidade($id, $aumento) {

		try {

			$sql = "SELECT qtd FROM livros WHERE id = :id AND qtd >= :qtd";

			$query = $this->pdo->prepare($sql);

			$query->execute(['id'=>$id,'qtd'=>$aumento]);

			$erros[0] = $query->errorInfo();

			if($erros[0] != 00000) {
				throw new Exception();
			}

			if($query->rowCount() == 1) {
				return true;
			}else {
				return false;
			}

		}catch(Exception $ex) {
			return false;
		}

	}

	public function devolverQuantidadeExistente($id) {

		try {

			$sql = "SELECT qtd FROM livros WHERE id = :id";

			$query = $this->pdo->prepare($sql);

			$query->execute(['id'=>$id]);

			$erros = $query->errorInfo();

			if($erros['0'] != 00000) {
				throw new Exception();
			}

			if($query->rowCount() == 1) {
				return $query->fetch(PDO::FETCH_ASSOC);
			}else {
				throw new Exception();
			}

		}catch(Exception $ex) {
			return 0;
		}

	}

}