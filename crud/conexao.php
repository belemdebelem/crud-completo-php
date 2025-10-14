<?php
// conexao.php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "crud"; // troque pelo nome do seu banco de dados

// Criar conexão
$conexao = new mysqli($host, $usuario, $senha, $banco);

// Checar conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

// Se chegar aqui, a conexão deu certo
// echo "Conexão realizada com sucesso!";
?>
