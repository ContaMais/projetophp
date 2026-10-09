<?php
// Cria a conexao mysqli_connect('servidor', 'usuario', 'senha', 'banco')
$conexao = mysqli_connect('localhost', 'root', '', 'bdexemplo');

// Ajusta o charset de comunicação
mysqli_set_charset($conexao, 'utf8');

// Verifica a conexao
if ($conexao->connect_error) {
die("Falha ao realizar a conexão: " . $conexao->connect_error);
}
?>