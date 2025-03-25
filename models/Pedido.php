<?php
/**
 * Classe que representa um pedido da hamburgueria
 */
class Pedido {
    private $id;
    private $cliente_nome;
    private $status;
    private $valor_total;
    private $observacao;
    private $itens = [];
    
    /**
     * Construtor da classe
     */
    public function __construct($id = null, $cliente_nome = null, $status = 'pendente', $valor_total = 0, $observacao = null) {
        $this->id = $id;
        $this->cliente_nome = $cliente_nome;
        $this->status = $status;
        $this->valor_total = $valor_total;
        $this->observacao = $observacao;
    }
    
    // Getters e Setters
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getClienteNome() {
        return $this->cliente_nome;
    }
    
    public function setClienteNome($cliente_nome) {
        $this->cliente_nome = $cliente_nome;
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }
    
    public function getValorTotal() {
        return $this->valor_total;
    }
    
    public function setValorTotal($valor_total) {
        $this->valor_total = $valor_total;
    }
    
    public function getObservacao() {
        return $this->observacao;
    }
    
    public function setObservacao($observacao) {
        $this->observacao = $observacao;
    }
    
    public function getItens() {
        return $this->itens;
    }
    
    public function setItens($itens) {
        $this->itens = $itens;
    }
    
    /**
     * Adiciona um item ao pedido
     */
    public function adicionarItem($produto_id, $quantidade, $valor_unitario, $observacao = null) {
        $subtotal = $quantidade * $valor_unitario;
        $this->itens[] = [
            'produto_id' => $produto_id,
            'quantidade' => $quantidade,
            'valor_unitario' => $valor_unitario,
            'subtotal' => $subtotal,
            'observacao' => $observacao
        ];
        $this->valor_total += $subtotal;
        return true;
    }
    
    /**
     * Formata o valor total para exibição
     */
    public function getValorTotalFormatado() {
        return 'R$ ' . number_format($this->valor_total, 2, ',', '.');
    }
    
    /**
     * Retorna o status formatado para exibição
     */
    public function getStatusFormatado() {
        $statusMap = [
            'pendente' => 'Pendente',
            'em_preparo' => 'Em Preparo',
            'pronto' => 'Pronto',
            'entregue' => 'Entregue',
            'cancelado' => 'Cancelado'
        ];
        
        return isset($statusMap[$this->status]) ? $statusMap[$this->status] : $this->status;
    }
    
    /**
     * Salva o pedido no banco de dados
     */
    public function salvar() {
        $db = Database::getInstance();
        
        try {
            $db->beginTransaction();
            
            if ($this->id) {
                // Atualizar pedido existente
                $sql = "UPDATE pedidos SET cliente_nome = :cliente_nome, status = :status, 
                        valor_total = :valor_total, observacao = :observacao, 
                        updated_at = NOW() WHERE id = :id";
                $params = [
                    ':id' => $this->id,
                    ':cliente_nome' => $this->cliente_nome,
                    ':status' => $this->status,
                    ':valor_total' => $this->valor_total,
                    ':observacao' => $this->observacao
                ];
                $db->query($sql, $params);
            } else {
                // Inserir novo pedido
                $sql = "INSERT INTO pedidos (cliente_nome, status, valor_total, observacao) 
                        VALUES (:cliente_nome, :status, :valor_total, :observacao)";
                $params = [
                    ':cliente_nome' => $this->cliente_nome,
                    ':status' => $this->status,
                    ':valor_total' => $this->valor_total,
                    ':observacao' => $this->observacao
                ];
                $this->id = $db->insert($sql, $params);
                
                // Inserir itens do pedido
                if (!empty($this->itens)) {
                    foreach ($this->itens as $item) {
                        $sql = "INSERT INTO itens_pedido (pedido_id, produto_id, quantidade, 
                                valor_unitario, subtotal, observacao) 
                                VALUES (:pedido_id, :produto_id, :quantidade, 
                                :valor_unitario, :subtotal, :observacao)";
                        $params = [
                            ':pedido_id' => $this->id,
                            ':produto_id' => $item['produto_id'],
                            ':quantidade' => $item['quantidade'],
                            ':valor_unitario' => $item['valor_unitario'],
                            ':subtotal' => $item['subtotal'],
                            ':observacao' => $item['observacao']
                        ];
                        $db->query($sql, $params);
                        
                        // Atualizar estoque
                        $estoque = Estoque::buscarPorProdutoId($item['produto_id']);
                        if ($estoque) {
                            $estoque->removerQuantidade($item['quantidade']);
                        }
                    }
                }
            }
            
            $db->commit();
            return $this->id;
        } catch (Exception $e) {
            $db->rollback();
            throw $e;
        }
    }
    
    /**
     * Atualiza o status do pedido
     */
    public function atualizarStatus($status) {
        $this->status = $status;
        $db = Database::getInstance();
        $sql = "UPDATE pedidos SET status = :status, updated_at = NOW() WHERE id = :id";
        $params = [':id' => $this->id, ':status' => $status];
        $db->query($sql, $params);
        return true;
    }
    
    /**
     * Busca um pedido pelo ID
     */
    public static function buscarPorId($id) {
        $db = Database::getInstance();
        $sql = "SELECT * FROM pedidos WHERE id = :id";
        $params = [':id' => $id];
        $dados = $db->fetch($sql, $params);
        
        if ($dados) {
            $pedido = new Pedido(
                $dados['id'],
                $dados['cliente_nome'],
                $dados['status'],
                $dados['valor_total'],
                $dados['observacao']
            );
            
            // Buscar itens do pedido
            $sql = "SELECT * FROM itens_pedido WHERE pedido_id = :pedido_id";
            $params = [':pedido_id' => $id];
            $itens = $db->fetchAll($sql, $params);
            $pedido->setItens($itens);
            
            return $pedido;
        }
        
        return null;
    }
    
    /**
     * Lista todos os pedidos
     */
    public static function listarTodos() {
        $db = Database::getInstance();
        $sql = "SELECT * FROM pedidos ORDER BY created_at DESC";
        $dados = $db->fetchAll($sql);
        
        $pedidos = [];
        foreach ($dados as $dado) {
            $pedidos[] = new Pedido(
                $dado['id'],
                $dado['cliente_nome'],
                $dado['status'],
                $dado['valor_total'],
                $dado['observacao']
            );
        }
        
        return $pedidos;
    }
    
    /**
     * Lista pedidos por status
     */
    public static function listarPorStatus($status) {
        $db = Database::getInstance();
        $sql = "SELECT * FROM pedidos WHERE status = :status ORDER BY created_at DESC";
        $params = [':status' => $status];
        $dados = $db->fetchAll($sql, $params);
        
        $pedidos = [];
        foreach ($dados as $dado) {
            $pedidos[] = new Pedido(
                $dado['id'],
                $dado['cliente_nome'],
                $dado['status'],
                $dado['valor_total'],
                $dado['observacao']
            );
        }
        
        return $pedidos;
    }