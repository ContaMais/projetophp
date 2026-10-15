<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Apagar Registo</title>
    <link rel="stylesheet" href="style.css">
<script src="glows.js"></script>
</head>
<body>
<?php
$var = isset($_GET['a']) ? $_GET['a'] : '';

if (!empty($var)) {
    $base = mysqli_connect('localhost', 'root', '', 'meu_projeto') or die("erro de conexão");
    mysqli_set_charset($base, 'utf8');

    $apagar = "DELETE FROM cadastro WHERE nome='$var'";
    mysqli_query($base, $apagar);

    echo "<h2>Registro excluído com sucesso!</h2>";
    echo "<hr>";
} else {
    echo "<h2>Nenhum registro selecionado para excluir.</h2>";
    echo "<hr>";
}

include 'lista.inc.php';
?>
</body>
</html>