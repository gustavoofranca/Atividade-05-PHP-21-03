# Gusta's Burguer - Sistema de Gerenciamento

Este é um sistema de gerenciamento para a hamburgueria Gusta's Burguer desenvolvido em PHP com orientação a objetos.

## Funcionalidades

- Gerenciamento de produtos (hambúrgueres, acompanhamentos, bebidas)
- Controle de estoque
- Sistema de pedidos
- Cadastro e autenticação de usuários

## Tecnologias Utilizadas

- PHP 7.4+
- MySQL
- HTML5, CSS3, JavaScript
- Bootstrap 5
- PDO para conexão com banco de dados

## Estrutura do Projeto

- `/config` - Arquivos de configuração
- `/models` - Classes de modelo (Produto, Estoque, Pedido, etc.)
- `/views` - Arquivos de visualização
- `/controllers` - Controladores para gerenciar a lógica de negócio
- `/assets` - Arquivos estáticos (CSS, JS, imagens)
- `/database` - Scripts SQL e classe de conexão com o banco de dados

## Instalação

1. Clone este repositório para seu servidor web local
2. Importe o arquivo SQL localizado em `/database/gustasburguer.sql` para criar o banco de dados
3. Configure as credenciais do banco de dados no arquivo `/config/database.php`
4. Acesse o sistema através do navegador

## Requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache, Nginx, etc.)