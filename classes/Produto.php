<?php

class Produto {
    private $nome;
    private $preco;
    private $quantidade;
    private $categoria;

    public function __construct($nome, $preco, $quantidade, $categoria = 'Geral') {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->quantidade = $quantidade;
        $this->categoria = $categoria;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function exibirInformacoes() {
        return [
            'nome' => $this->nome,
            'preco' => $this->preco,
            'quantidade' => $this->quantidade,
            'categoria' => $this->categoria
        ];
    }

    public function aplicarDesconto($percentual) {
        if ($percentual > 0 && $percentual <= 100) {
            $desconto = ($this->preco * $percentual) / 100;
            $this->preco -= $desconto;
            return true;
        }
        return false;
    }

    public function atualizarQuantidade($quantidade) {
        if ($quantidade >= 0) {
            $this->quantidade = $quantidade;
            return true;
        }
        return false;
    }

    public function adicionarQuantidade($quantidade) {
        if ($quantidade > 0) {
            $this->quantidade += $quantidade;
            return true;
        }
        return false;
    }

    public function removerQuantidade($quantidade) {
        if ($quantidade > 0 && $quantidade <= $this->quantidade) {
            $this->quantidade -= $quantidade;
            return true;
        }
        return false;
    }
}