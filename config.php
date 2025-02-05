<?php 
session_start();

// Configuração da base de dados
$host = 'localhost'; // Endereço do servidor
$db = 'crialme'; // Nome da base de dados
$user = 'root'; // Utilizador da base de dados
$password = ''; // Passowrd dda base de dados

// Conexão da base de dados
$conn = new mysqli($host, $user, $password, $db);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>
