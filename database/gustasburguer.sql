-- Script SQL para criação do banco de dados da hamburgueria Gusta's Burguer

-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS gustasburguer;
USE gustasburguer;

-- Tabela de categorias de produtos
CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    descricao TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela de produtos
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    imagem VARCHAR(255),
    disponivel BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE CASCADE
);

-- Tabela de estoque
CREATE TABLE IF NOT EXISTS estoque (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 0,
    quantidade_minima INT DEFAULT 5,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE
);

-- Tabela de usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('admin', 'funcionario') NOT NULL DEFAULT 'funcionario',
    ativo BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela de pedidos
CREATE TABLE IF NOT EXISTS pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_nome VARCHAR(100),
    status ENUM('pendente', 'em_preparo', 'pronto', 'entregue', 'cancelado') DEFAULT 'pendente',
    valor_total DECIMAL(10,2) NOT NULL,
    observacao TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela de carrinhos
CREATE TABLE IF NOT EXISTS carrinhos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    session_id VARCHAR(255) NOT NULL,
    usuario_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
);

-- Tabela de itens do carrinho
CREATE TABLE IF NOT EXISTS itens_carrinho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    carrinho_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (carrinho_id) REFERENCES carrinhos(id) ON DELETE CASCADE,
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE
);

-- Tabela de itens do pedido
CREATE TABLE IF NOT EXISTS itens_pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    valor_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    observacao TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

-- Inserir categorias padrão
INSERT INTO categorias (nome, descricao) VALUES
('Hambúrgueres', 'Hambúrgueres artesanais'),
('Acompanhamentos', 'Acompanhamentos para hambúrgueres'),
('Bebidas', 'Refrigerantes, sucos e outras bebidas'),
('Sobremesas', 'Sobremesas e doces');

-- Inserir produtos de exemplo
INSERT INTO produtos (categoria_id, nome, descricao, preco, disponivel) VALUES
(1, 'Hambúrguer Clássico', 'Pão, hambúrguer 180g, queijo, alface, tomate e molho especial', 25.90, TRUE),
(1, 'Hambúrguer Bacon', 'Pão, hambúrguer 180g, queijo cheddar, bacon crocante, alface, tomate e molho especial', 29.90, TRUE),
(1, 'Hambúrguer Vegetariano', 'Pão, hambúrguer de grão de bico, queijo, alface, tomate, cebola roxa e molho especial', 27.90, TRUE),
(2, 'Batata Frita', 'Porção de batata frita crocante', 12.90, TRUE),
(2, 'Onion Rings', 'Anéis de cebola empanados', 15.90, TRUE),
(3, 'Refrigerante', 'Lata 350ml', 6.90, TRUE),
(3, 'Suco Natural', 'Copo 300ml', 8.90, TRUE),
(4, 'Brownie', 'Brownie de chocolate com sorvete', 14.90, TRUE);

-- Inserir estoque inicial
INSERT INTO estoque (produto_id, quantidade, quantidade_minima) VALUES
(1, 50, 10),
(2, 50, 10),
(3, 30, 5),
(4, 100, 20),
(5, 80, 15),
(6, 120, 30),
(7, 50, 10),
(8, 40, 10);

-- Inserir usuário administrador padrão (senha: admin123)
INSERT INTO usuarios (nome, email, senha, tipo) VALUES
('Administrador', 'admin@gustasburguer.com', '$2y$10$8tGmHMJQYY9LQYdW7JF6NeRQmZI8Nh2G3z6FxQ4hVlAI1/ygHDp4.', 'admin');