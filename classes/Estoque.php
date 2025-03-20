<?php

require_once 'Produto.php';

class Estoque {
    private $produtos = [];
    
    public function adicionarProduto(Produto $produto) {
        $this->produtos[] = $produto;
        return true;
    }
    
    public function listarProdutos() {
        return $this->produtos;
    }
    
    public function calcularValorTotal() {
        $valorTotal = 0;
        foreach ($this->produtos as $produto) {
            $valorTotal += $produto->getPreco() * $produto->getQuantidade();
        }
        return $valorTotal;
    }
    
    public function removerProduto($index) {
        if (isset($this->produtos[$index])) {
            unset($this->produtos[$index]);
            $this->produtos = array_values($this->produtos); // Reindex array
            return true;
        }
        return false;
    }
    
    public function buscarProdutoPorNome($nome) {
        foreach ($this->produtos as $index => $produto) {
            if (strtolower($produto->getNome()) === strtolower($nome)) {
                return ['produto' => $produto, 'index' => $index];
            }
        }
        return null;
    }
    
    public function listarProdutosPorCategoria($categoria) {
        $produtosFiltrados = [];
        foreach ($this->produtos as $produto) {
            if (strtolower($produto->getCategoria()) === strtolower($categoria)) {
                $produtosFiltrados[] = $produto;
            }
        }
        return $produtosFiltrados;
    }
    
    public function contarProdutos() {
        return count($this->produtos);
    }
}