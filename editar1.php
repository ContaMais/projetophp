<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Atualizar Registo</title>
    <link rel="stylesheet" href="style.css">
<script src="glows.js"></script>
</head>
<body>
<?php
echo "<h2>Atualizando o cadastro!</h2>";

$nome = $_POST['nome'];
$email = $_POST['email'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];

$base = mysqli_connect('localhost', 'root', '', 'meu_projeto') or die("erro de conexão");
mysqli_set_charset($base, 'utf8');

$regra = "UPDATE cadastro SET email='$email', cidade='$cidade', estado='$estado' WHERE nome='$nome'";
$res = mysqli_query($base, $regra) or die("Erro na atualização");

echo "<hr>";
include 'lista.inc.php';
?>
</body>
</html>