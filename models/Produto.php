<?php
/**
 * Classe que representa um produto da hamburgueria
 */
class Produto {
    private $id;
    private $categoria_id;
    private $nome;
    private $descricao;
    private $preco;
    private $imagem;
    private $disponivel;
    
    /**
     * Construtor da classe
     */
    public function __construct($id = null, $categoria_id = null, $nome = null, $descricao = null, $preco = 0, $imagem = null, $disponivel = true) {
        $this->id = $id;
        $this->categoria_id = $categoria_id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->imagem = $imagem;
        $this->disponivel = $disponivel;
    }
    
    // Getters e Setters
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getCategoriaId() {
        return $this->categoria_id;
    }
    
    public function setCategoriaId($categoria_id) {
        $this->categoria_id = $categoria_id;
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
    
    public function getPreco() {
        return $this->preco;
    }
    
    public function setPreco($preco) {
        $this->preco = $preco;
    }
    
    public function getImagem() {
        return $this->imagem;
    }
    
    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }
    
    public function getDisponivel() {
        return $this->disponivel;
    }
    
    public function setDisponivel($disponivel) {
        $this->disponivel = $disponivel;
    }
    
    /**
     * Formata o preço para exibição
     */
    public function getPrecoFormatado() {
        return 'R$ ' . number_format($this->preco, 2, ',', '.');
    }
    
    /**
     * Salva o produto no banco de dados
     */
    public function salvar() {
        $db = Database::getInstance();
        
        if ($this->id) {
            // Atualizar produto existente
            $sql = "UPDATE produtos SET categoria_id = :categoria_id, nome = :nome, 
                    descricao = :descricao, preco = :preco, imagem = :imagem, 
                    disponivel = :disponivel, updated_at = NOW() WHERE id = :id";
            $params = [
                ':id' => $this->id,
                ':categoria_id' => $this->categoria_id,
                ':nome' => $this->nome,
                ':descricao' => $this->descricao,
                ':preco' => $this->preco,
                ':imagem' => $this->imagem,
                ':disponivel' => $this->disponivel ? 1 : 0
            ];
            $db->query($sql, $params);
            return $this->id;
        } else {
            // Inserir novo produto
            $sql = "INSERT INTO produtos (categoria_id, nome, descricao, preco, imagem, disponivel) 
                    VALUES (:categoria_id, :nome, :descricao, :preco, :imagem, :disponivel)";
            $params = [
                ':categoria_id' => $this->categoria_id,
                ':nome' => $this->nome,
                ':descricao' => $this->descricao,
                ':preco' => $this->preco,
                ':imagem' => $this->imagem,
                ':disponivel' => $this->disponivel ? 1 : 0
            ];
            $this->id = $db->insert($sql, $params);
            
            // Criar estoque para o novo produto
            $estoque = new Estoque(null, $this->id, 0, 5);
            $estoque->salvar();
            
            return $this->id;
        }
    }
    
    /**
     * Busca um produto pelo ID
     */
    public static function buscarPorId($id) {
        $db = Database::getInstance();
        $sql = "SELECT * FROM produtos WHERE id = :id";
        $params = [':id' => $id];
        $dados = $db->fetch($sql, $params);
        
        if ($dados) {
            return new Produto(
                $dados['id'],
                $dados['categoria_id'],
                $dados['nome'],
                $dados['descricao'],
                $dados['preco'],
                $dados['imagem'],
                $dados['disponivel']
            );
        }
        
        return null;
    }
    
    /**
     * Lista todos os produtos
     */
    public static function listarTodos() {
        $db = Database::getInstance();
        $sql = "SELECT p.*, c.nome as categoria_nome FROM produtos p 
                INNER JOIN categorias c ON p.categoria_id = c.id 
                ORDER BY p.nome";
        $dados = $db->fetchAll($sql);
        
        $produtos = [];
        foreach ($dados as $dado) {
            $produto = new Produto(
                $dado['id'],
                $dado['categoria_id'],
                $dado['nome'],
                $dado['descricao'],
                $dado['preco'],
                $dado['imagem'],
                $dado['disponivel']
            );
            $produto->categoria_nome = $dado['categoria_nome'];
            $produtos[] = $produto;
        }
        
        return $produtos;
    }
    
    /**
     * Lista produtos por categoria
     */
    public static function listarPorCategoria($categoria_id) {
        $db = Database::getInstance();
        $sql = "SELECT p.*, c.nome as categoria_nome FROM produtos p 
                INNER JOIN categorias c ON p.categoria_id = c.id 
                WHERE p.categoria_id = :categoria_id 
                ORDER BY p.nome";
        $params = [':categoria_id' => $categoria_id];
        $dados = $db->fetchAll($sql, $params);
        
        $produtos = [];
        foreach ($dados as $dado) {
            $produto = new Produto(
                $dado['id'],
                $dado['categoria_id'],
                $dado['nome'],
                $dado['descricao'],
                $dado['preco'],
                $dado['imagem'],
                $dado['disponivel']
            );
            $produto->categoria_nome = $dado['categoria_nome'];
            $produtos[] = $produto;
        }
        
        return $produtos;
    }
    
    /**
     * Exclui um produto pelo ID
     */
    public static function excluir($id) {
        $db = Database::getInstance();
        $sql = "DELETE FROM produtos WHERE id = :id";
        $params = [':id' => $id];
        $db->query($sql, $params);
        return true;
    }
}