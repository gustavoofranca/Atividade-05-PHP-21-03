<?php
/**
 * Arquivo de configuração principal do sistema
 */

// Configurações de Banco de Dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'gustasburguer');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Configurações de Timezone
date_default_timezone_set('America/Sao_Paulo');

// Configurações de Erro (desenvolvimento)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir arquivo de conexão com o banco de dados
require_once ROOT_PATH . '/database/Database.php';

// Carregar classes de modelo automaticamente
spl_autoload_register(function ($class_name) {
    $file = ROOT_PATH . '/models/' . $class_name . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});