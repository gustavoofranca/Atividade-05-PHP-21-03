<?php
/**
 * Classe que representa o estoque de produtos
 */
class Estoque {
    private $id;
    private $produto_id;
    private $quantidade;
    private $quantidade_minima;
    
    /**
     * Construtor da classe
     */
    public function __construct($id = null, $produto_id = null, $quantidade = 0, $quantidade_minima = 5) {
        $this->id = $id;
        $this->produto_id = $produto_id;
        $this->quantidade = $quantidade;
        $this->quantidade_minima = $quantidade_minima;
    }
    
    // Getters e Setters
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getProdutoId() {
        return $this->produto_id;
    }
    
    public function setProdutoId($produto_id) {
        $this->produto_id = $produto_id;
    }
    
    public function getQuantidade() {
        return $this->quantidade;
    }
    
    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }
    
    public function getQuantidadeMinima() {
        return $this->quantidade_minima;
    }
    
    public function setQuantidadeMinima($quantidade_minima) {
        $this->quantidade_minima = $quantidade_minima;
    }
    
    /**
     * Verifica se o estoque está abaixo do mínimo
     */
    public function estaAbaixoDoMinimo() {
        return $this->quantidade < $this->quantidade_minima;
    }
    
    /**
     * Adiciona quantidade ao estoque
     */
    public function adicionarQuantidade($quantidade) {
        $this->quantidade += $quantidade;
        return $this->salvar();
    }
    
    /**
     * Remove quantidade do estoque
     */
    public function removerQuantidade($quantidade) {
        if ($this->quantidade >= $quantidade) {
            $this->quantidade -= $quantidade;
            return $this->salvar();
        }
        return false;
    }
    
    /**
     * Salva o estoque no banco de dados
     */
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
            $db->query($sql, $params);
            return $this->id;
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
    
    /**
     * Busca um estoque pelo ID do produto
     */
    public static function buscarPorProdutoId($produto_id) {
        $db = Database::getInstance();
        $sql = "SELECT * FROM estoque WHERE produto_id = :produto_id";
        $params = [':produto_id' => $produto_id];
        $dados = $db->fetch($sql, $params);
        
        if ($dados) {
            return new Estoque(
                $dados['id'],
                $dados['produto_id'],
                $dados['quantidade'],
                $dados['quantidade_minima']
            );
        }
        
        return null;
    }
    
    /**
     * Lista todos os estoques com informações dos produtos
     */
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
                $dado['quantidade'],
                $dado['quantidade_minima']
            );
            $estoque->produto_nome = $dado['produto_nome'];
            $estoques[] = $estoque;
        }
        
        return $estoques;
    }
    
    /**
     * Lista produtos com estoque abaixo do mínimo
     */
    public static function listarAbaixoDoMinimo() {
        $db = Database::getInstance();
        $sql = "SELECT e.*, p.nome as produto_nome FROM estoque e 
                INNER JOIN produtos p ON e.produto_id = p.id 
                WHERE e.quantidade < e.quantidade_minima 
                ORDER BY p.nome";
        $dados = $db->fetchAll($sql);
        
        $estoques = [];
        foreach ($dados as $dado) {
            $estoque = new Estoque(
                $dado['id'],
                $dado['produto_id'],
                $dado['quantidade'],
                $dado['quantidade_minima']
            );
            $estoque->produto_nome = $dado['produto_nome'];
            $estoques[] = $estoque;
        }
        
        return $estoques;
    }