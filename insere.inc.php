<?php
include 'conecta_mysql.inc.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$comentarios = $_POST['comentarios'];

$sql = "INSERT INTO cadastro (nome, email, cidade, estado, comentarios) VALUES ";
$sql .= "('$nome', '$email', '$cidade', '$estado', '$comentarios')";

if ($conexao->query($sql) === TRUE) {
echo "Usuário incluído com sucesso!";
} else {
echo "Erro: " . $sql . "<br>" . $conexao->error;
}

$conexao->close();
?>