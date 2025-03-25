<?php

require_once 'database/Database.php';

class CartController
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getOrCreateCart()
    {
        session_start();
        $session_id = session_id();
        $usuario_id = isset($_SESSION['usuario']) ? $_SESSION['usuario']['id'] : null;

        // Check if cart exists for this session
        $sql = "SELECT id FROM carrinhos WHERE session_id = ?";
        $cart = $this->db->query($sql, [$session_id])->fetch();

        if (!$cart) {
            // Create new cart
            $sql = "INSERT INTO carrinhos (session_id, usuario_id) VALUES (?, ?)";
            $this->db->query($sql, [$session_id, $usuario_id]);
            return $this->db->lastInsertId();
        }

        return $cart['id'];
    }

    public function addItem($produto_id, $quantidade = 1)
    {
        $carrinho_id = $this->getOrCreateCart();

        // Check if item already exists in cart
        $sql = "SELECT id, quantidade FROM itens_carrinho WHERE carrinho_id = ? AND produto_id = ?";
        $item = $this->db->query($sql, [$carrinho_id, $produto_id])->fetch();

        if ($item) {
            // Update quantity
            $sql = "UPDATE itens_carrinho SET quantidade = quantidade + ? WHERE id = ?";
            $this->db->query($sql, [$quantidade, $item['id']]);
        } else {
            // Insert new item
            $sql = "INSERT INTO itens_carrinho (carrinho_id, produto_id, quantidade) VALUES (?, ?, ?)";
            $this->db->query($sql, [$carrinho_id, $produto_id, $quantidade]);
        }

        return $this->getCartItems();
    }

    public function updateItemQuantity($produto_id, $quantidade)
    {
        $carrinho_id = $this->getOrCreateCart();

        if ($quantidade <= 0) {
            // Remove item
            $sql = "DELETE FROM itens_carrinho WHERE carrinho_id = ? AND produto_id = ?";
            $this->db->query($sql, [$carrinho_id, $produto_id]);
        } else {
            // Update quantity
            $sql = "UPDATE itens_carrinho SET quantidade = ? WHERE carrinho_id = ? AND produto_id = ?";
            $this->db->query($sql, [$quantidade, $carrinho_id, $produto_id]);
        }

        return $this->getCartItems();
    }

    public function getCartItems()
    {
        $carrinho_id = $this->getOrCreateCart();

        $sql = "SELECT ic.*, p.nome, p.preco, p.imagem 
                FROM itens_carrinho ic 
                JOIN produtos p ON ic.produto_id = p.id 
                WHERE ic.carrinho_id = ?";

        $items = $this->db->query($sql, [$carrinho_id])->fetchAll();

        $formattedItems = [];
        foreach ($items as $item) {
            $formattedItems[] = [
                'id' => (int)$item['produto_id'],
                'name' => $item['nome'],
                'price' => (float)$item['preco'],
                'image' => $item['imagem'],
                'quantity' => (int)$item['quantidade']
            ];
        }

        return $formattedItems;
    }

    public function clearCart()
    {
        $carrinho_id = $this->getOrCreateCart();
        $sql = "DELETE FROM itens_carrinho WHERE carrinho_id = ?";
        $this->db->query($sql, [$carrinho_id]);
    }
    
    // Action methods to handle AJAX requests
    
    public function index()
    {
        // Default action - redirect to cardapio
        header('Location: ' . BASE_URL . '?page=cardapio');
        exit;
    }
    
    public function get()
    {
        header('Content-Type: application/json');
        echo json_encode($this->getCartItems());
        exit;
    }
    
    public function add()
    {
        // Get JSON data from request
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        
        if (!isset($data['produto_id']) || !isset($data['quantidade'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Dados inválidos']);
            exit;
        }
        
        $produto_id = (int)$data['produto_id'];
        $quantidade = (int)$data['quantidade'];
        
        $result = $this->addItem($produto_id, $quantidade);
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    
    public function update()
    {
        // Get JSON data from request
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        
        if (!isset($data['produto_id']) || !isset($data['quantidade'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Dados inválidos']);
            exit;
        }
        
        $produto_id = (int)$data['produto_id'];
        $quantidade = (int)$data['quantidade'];
        
        $result = $this->updateItemQuantity($produto_id, $quantidade);
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    
    public function remove()
    {
        // Get JSON data from request
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        
        if (!isset($data['produto_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Dados inválidos']);
            exit;
        }
        
        $produto_id = (int)$data['produto_id'];
        
        $result = $this->updateItemQuantity($produto_id, 0); // Set quantity to 0 to remove
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
}