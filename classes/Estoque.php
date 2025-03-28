<?php

class Estoque {
    private $id;
    private $produto_id;
    private $produto;
    private $quantidade;
    private $quantidade_minima;

    public function __construct($id = null, $produto_id = null, $produto = null, $quantidade = 0, $quantidade_minima = 5) {
        $this->id = $id;
        $this->produto_id = $produto_id;
        $this->produto = $produto;
        $this->quantidade = $quantidade;
        $this->quantidade_minima = $quantidade_minima;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getProdutoId() {
        return $this->produto_id;
    }

    public function getProduto() {
        return $this->produto;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function getQuantidadeMinima() {
        return $this->quantidade_minima;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setProdutoId($produto_id) {
        $this->produto_id = $produto_id;
    }

    public function setProduto($produto) {
        $this->produto = $produto;
    }

    public function setQuantidade($quantidade) {
        if ($quantidade >= 0) {
            $this->quantidade = $quantidade;
            return true;
        }
        return false;
    }

    public function setQuantidadeMinima($quantidade_minima) {
        if ($quantidade_minima >= 0) {
            $this->quantidade_minima = $quantidade_minima;
            return true;
        }
        return false;
    }

    // Métodos de negócio
    public function estaAbaixoDoMinimo() {
        return $this->quantidade < $this->quantidade_minima;
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

    // Métodos de persistência
    public function salvar() {
        $db = Database::getInstance();
        
        if ($this->id) {
            // Atualizar estoque existente
            $sql = "UPDATE estoque SET produto_id = :produto_id, quantidade = :quantidade, 
                    quantidade_minima = :quantidade_minima, updated_at = NOW() WHERE id = :id";
            $params = [
                ':id' => $this->id,
                ':produto_id' => $this->produto_id,
                ':quantidade' => $this->quantidade,
                ':quantidade_minima' => $this->quantidade_minima
            ];
            return $db->query($sql, $params);
        } else {
            // Inserir novo estoque
            $sql = "INSERT INTO estoque (produto_id, quantidade, quantidade_minima) 
                    VALUES (:produto_id, :quantidade, :quantidade_minima)";
            $params = [
                ':produto_id' => $this->produto_id,
                ':quantidade' => $this->quantidade,
                ':quantidade_minima' => $this->quantidade_minima
            ];
            $this->id = $db->insert($sql, $params);
            return $this->id;
        }
    }

    public static function buscarPorId($id) {
        $db = Database::getInstance();
        $sql = "SELECT * FROM estoque WHERE id = :id";
        $params = [':id' => $id];
        $dados = $db->fetch($sql, $params);
        
        if ($dados) {
            return new Estoque(
                $dados['id'],
                $dados['produto_id'],
                null,
                $dados['quantidade'],
                $dados['quantidade_minima']
            );
        }
        
        return null;
    }

    public static function buscarPorProdutoId($produto_id) {
        $db = Database::getInstance();
        $sql = "SELECT * FROM estoque WHERE produto_id = :produto_id";
        $params = [':produto_id' => $produto_id];
        $dados = $db->fetch($sql, $params);
        
        if ($dados) {
            return new Estoque(
                $dados['id'],
                $dados['produto_id'],
                null,
                $dados['quantidade'],
                $dados['quantidade_minima']
            );
        }
        
        // Se não existir, criar um novo registro de estoque para o produto
        $estoque = new Estoque(null, $produto_id, null, 0, 5);
        $estoque->salvar();
        return $estoque;
    }

    public static function listarTodos() {
        $db = Database::getInstance();
        $sql = "SELECT e.*, p.nome as produto_nome FROM estoque e 
                INNER JOIN produtos p ON e.produto_id = p.id 
                ORDER BY p.nome";
        $dados = $db->fetchAll($sql);
        
        $estoques = [];
        foreach ($dados as $dado) {
            $estoque = new Estoque(
                $dado['id'],
                $dado['produto_id'],
                null,
                $dado['quantidade'],
                $dado['quantidade_minima']
            );
            $estoque->produto_nome = $dado['produto_nome'];
            $estoques[] = $estoque;
        }
        
        return $estoques;
    }
}