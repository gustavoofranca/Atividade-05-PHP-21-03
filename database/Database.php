<?php
/**
 * Classe para gerenciar a conexão com o banco de dados usando PDO
 */
class Database {
    private static $instance = null;
    private $conn;
    
    /**
     * Construtor privado para implementar o padrão Singleton
     */
    private function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
            
            $this->conn = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }
    
    /**
     * Método para obter a instância única da conexão (Singleton)
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Método para obter a conexão PDO
     */
    public function getConnection() {
        return $this->conn;
    }
    
    /**
     * Método para executar consultas SQL
     */
    public function query($sql, $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("Erro na consulta: " . $e->getMessage());
        }
    }
    
    /**
     * Método para obter um único registro
     */
    public function fetch($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }
    
    /**
     * Método para obter todos os registros
     */
    public function fetchAll($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }
    
    /**
     * Método para inserir dados e retornar o ID inserido
     */
    public function insert($sql, $params = []) {
        $this->query($sql, $params);
        return $this->conn->lastInsertId();
    }
    
    /**
     * Método para iniciar uma transação
     */
    public function beginTransaction() {
        return $this->conn->beginTransaction();
    }
    
    /**
     * Método para confirmar uma transação
     */
    public function commit() {
        return $this->conn->commit();
    }
    
    /**
     * Método para reverter uma transação
     */
    public function rollback() {
        return $this->conn->rollBack();
    }
}