<?php
// Configurações de conexão com o banco de dados
$servidor = "localhost"; // Ou o endereço do seu servidor
$usuario = "avanc958_maik";  // Seu usuário do banco de dados (ajuste conforme necessário)
$senha = "sua_senha";  // Sua senha (ajuste conforme necessário)
$banco = "avanc958_maik";  // Nome do seu banco de dados (ajuste conforme necessário)

// Cria a conexão com o banco de dados
$mysqli = new mysqli($servidor, $usuario, $senha, $banco);

// Verifica a conexão
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

// Define o charset como utf8
$mysqli->set_charset("utf8");
?>








