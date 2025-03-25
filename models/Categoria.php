<?php
/**
 * Classe que representa uma categoria de produtos
 */
class Categoria {
    private $id;
    private $nome;
    private $descricao;
    
    /**
     * Construtor da classe
     */
    public function __construct($id = null, $nome = null, $descricao = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
    }
    
    // Getters e Setters
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function getDescricao() {
        return $this->descricao;
    }
    
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
    /**
     * Salva a categoria no banco de dados
     */
    public function salvar() {
        $db = Database::getInstance();
        
        if ($this->id) {
            // Atualizar categoria existente
            $sql = "UPDATE categorias SET nome = :nome, descricao = :descricao, 
                    updated_at = NOW() WHERE id = :id";
            $params = [
                ':id' => $this->id,
                ':nome' => $this->nome,
                ':descricao' => $this->descricao
            ];
            $db->query($sql, $params);
            return $this->id;
        } else {
            // Inserir nova categoria
            $sql = "INSERT INTO categorias (nome, descricao) VALUES (:nome, :descricao)";
            $params = [
                ':nome' => $this->nome,
                ':descricao' => $this->descricao
            ];
            $this->id = $db->insert($sql, $params);
            return $this->id;
        }
    }
    
    /**
     * Busca uma categoria pelo ID
     */
    public static function buscarPorId($id) {
        $db = Database::getInstance();
        $sql = "SELECT * FROM categorias WHERE id = :id";
        $params = [':id' => $id];
        $dados = $db->fetch($sql, $params);
        
        if ($dados) {
            return new Categoria(
                $dados['id'],
                $dados['nome'],
                $dados['descricao']
            );
        }
        
        return null;
    }
    
    /**
     * Lista todas as categorias
     */
    public static function listarTodas() {
        $db = Database::getInstance();
        $sql = "SELECT * FROM categorias ORDER BY nome";
        $dados = $db->fetchAll($sql);
        
        $categorias = [];
        foreach ($dados as $dado) {
            $categorias[] = new Categoria(
                $dado['id'],
                $dado['nome'],
                $dado['descricao']
            );
        }
        
        return $categorias;
    }
    
    /**
     * Exclui uma categoria pelo ID
     */
    public static function excluir($id) {
        $db = Database::getInstance();
        $sql = "DELETE FROM categorias WHERE id = :id";
        $params = [':id' => $id];
        $db->query($sql, $params);
        return true;
    }
}