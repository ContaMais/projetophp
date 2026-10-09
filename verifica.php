<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verifica</title>
    <link rel="stylesheet" href="style.css">
<script src="glows.js"></script>
</head>
<body>
<?php
$nome = $_POST['nome'];
$email = $_POST['email'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$comentarios = $_POST['comentarios'];

$erro = 0;

if (empty($nome) || strstr($nome, ' ') === FALSE) {
    echo "Favor digitar seu nome corretamente.<br>";
    $erro = 1;
}

if (strlen($email) < 8 || strstr($email, '@') === FALSE) {
    echo "Favor digitar seu email corretamente.<br>";
    $erro = 1;
}

if (empty($cidade)) {
    echo "Favor digitar sua cidade.<br>";
    $erro = 1;
}

if (strlen($estado) != 2) {
    echo "Favor digitar o seu estado corretamente.<br>";
    $erro = 1;
}

if (empty($comentarios)) {
    echo "Favor entre com algum comentário.<br>";
    $erro = 1;
}

if ($erro == 0) {
    echo "Todos os dados foram digitados corretamente.<br>";
    include 'insere.inc.php';
    echo "<br><hr><br>";
    include 'lista.inc.php';
}
?>
</body>
</html>