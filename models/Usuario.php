<?php
/**
 * Classe que representa um usuário do sistema
 */
class Usuario {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $tipo;
    private $ativo;
    
    /**
     * Construtor da classe
     */
    public function __construct($id = null, $nome = null, $email = null, $senha = null, $tipo = 'funcionario', $ativo = true) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->tipo = $tipo;
        $this->ativo = $ativo;
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
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getSenha() {
        return $this->senha;
    }
    
    public function setSenha($senha) {
        // Criptografar a senha se não estiver criptografada
        if (strlen($senha) < 60) {
            $this->senha = password_hash($senha, PASSWORD_DEFAULT);
        } else {
            $this->senha = $senha;
        }
    }
    
    public function getTipo() {
        return $this->tipo;
    }
    
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    
    public function getAtivo() {
        return $this->ativo;
    }
    
    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }
    
    /**
     * Verifica se o usuário é administrador
     */
    public function isAdmin() {
        return $this->tipo === 'admin';
    }
    
    /**
     * Salva o usuário no banco de dados
     */
    public function salvar() {
        $db = Database::getInstance();
        
        if ($this->id) {
            // Atualizar usuário existente
            $sql = "UPDATE usuarios SET nome = :nome, email = :email, 
                    senha = :senha, tipo = :tipo, ativo = :ativo, 
                    updated_at = NOW() WHERE id = :id";
            $params = [
                ':id' => $this->id,
                ':nome' => $this->nome,
                ':email' => $this->email,
                ':senha' => $this->senha,
                ':tipo' => $this->tipo,
                ':ativo' => $this->ativo ? 1 : 0
            ];
            $db->query($sql, $params);
            return $this->id;
        } else {
            // Inserir novo usuário
            $sql = "INSERT INTO usuarios (nome, email, senha, tipo, ativo) 
                    VALUES (:nome, :email, :senha, :tipo, :ativo)";
            $params = [
                ':nome' => $this->nome,
                ':email' => $this->email,
                ':senha' => $this->senha,
                ':tipo' => $this->tipo,
                ':ativo' => $this->ativo ? 1 : 0
            ];
            $this->id = $db->insert($sql, $params);
            return $this->id;
        }
    }
    
    /**
     * Autentica um usuário pelo email e senha
     */
    public static function autenticar($email, $senha) {
        $db = Database::getInstance();
        $sql = "SELECT * FROM usuarios WHERE email = :email AND ativo = 1";
        $params = [':email' => $email];
        $dados = $db->fetch($sql, $params);
        
        if ($dados && password_verify($senha, $dados['senha'])) {
            return new Usuario(
                $dados['id'],
                $dados['nome'],
                $dados['email'],
                $dados['senha'],
                $dados['tipo'],
                $dados['ativo']
            );
        }
        
        return null;
    }
    
    /**
     * Busca um usuário pelo ID
     */
    public static function buscarPorId($id) {
        $db = Database::getInstance();
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $params = [':id' => $id];
        $dados = $db->fetch($sql, $params);
        
        if ($dados) {
            return new Usuario(
                $dados['id'],
                $dados['nome'],
                $dados['email'],
                $dados['senha'],
                $dados['tipo'],
                $dados['ativo']
            );
        }
        
        return null;
    }
    
    /**
     * Lista todos os usuários
     */
    public static function listarTodos() {
        $db = Database::getInstance();
        $sql = "SELECT * FROM usuarios ORDER BY nome";
        $dados = $db->fetchAll($sql);
        
        $usuarios = [];
        foreach ($dados as $dado) {
            $usuarios[] = new Usuario(
                $dado['id'],
                $dado['nome'],
                $dado['email'],
                $dado['senha'],
                $dado['tipo'],
                $dado['ativo']
            );
        }
        
        return $usuarios;
    }
    
    /**
     * Exclui um usuário pelo ID
     */
    public static function excluir($id) {
        $db = Database::getInstance();
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $params = [':id' => $id];
        $db->query($sql, $params);
        return true;
    }
}