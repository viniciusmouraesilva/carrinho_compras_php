<?php

class Livro {

	private $id;
	private $isbn;
	private $titulo;
	private $subtitulo;
	private $autor;
	private $edicao;
	private $descricao;
	private $qtd;
	private $preco;
	private $numeroPaginas;
	private $editora;
	private $imagem;

	public function setId($id) {
		$this->id = $id;
	}

	public function getId() {
		return $this->id;
	}

	public function getIsbn() {
		return $this->isbn;
	}

	public function setTitulo($nome) {
		$this->titulo = $titulo;
	}

	public function getTitulo() {
		return $this->titulo;
	}

	public function setSubtitulo($subtitulo) {
		$this->subtitulo = $subtitulo;
	}

	public function getSubtitulo() {
		return $this->subtitulo;
	}

	public function setAutor($autor) {
		$this->autor = $autor;
	}

	public function getAutor() {
		return $this->autor;
	}

	public function setEdicao($edicao) {
		$this->edicao = $edicao;
	}

	public function getEdicao() {
		return $this->edicao;
	}

	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}

	public function getDescricao() {
		return $this->descricao;
	}

	public function setQtd($qtd) {
		$this->qtd = $qtd;
	}

	public function getQtd() {
		return $this->qtd;
	}

	public function setPreco($preco) {
		$this->preco = $preco;
	}

	public function getPreco() {
		return $this->preco;
	}

	public function setNumeroPaginas($numeroPaginas) {
		$this->numeroPaginas = $numeroPaginas;
	}

	public function getNumeroPaginas() {
		return $this->numeroPaginas;
	}

	public function setEitora($editora) {
		$this->editora = $editora;
	}

	public function getEditora() {
		return $this->editora;
	}

	public function getImagem() {
		return $this->imagem;
	}
}