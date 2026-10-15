<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Registo</title>
    <link rel="stylesheet" href="style.css">
<script src="glows.js"></script>
</head>
<body>
<?php
$var = $_GET['a'];

$base = mysqli_connect('localhost', 'root', '', 'meu_projeto') or die("erro de conexão");
mysqli_set_charset($base, 'utf8');

$regra = "SELECT * FROM cadastro WHERE nome = '$var'";
$res = mysqli_query($base, $regra);
$mostrar = mysqli_fetch_array($res);

echo "<h2>Altere os dados do seu cadastro</h2>";
?>

<form method="POST" action="editar1.php">
<pre>
Nome:    <input type="text" size="35" maxlength="256" name="nome" value="<?php echo $mostrar['nome']; ?>" readonly="true"/>
E-mail:  <input type="text" size="35" maxlength="256" name="email" value="<?php echo $mostrar['email']; ?>"/>
Cidade:  <input type="text" size="35" maxlength="256" name="cidade" value="<?php echo $mostrar['cidade']; ?>"/>
Estado:  <input type="text" size="2" maxlength="2" name="estado" value="<?php echo $mostrar['estado']; ?>"/>

<input type="submit" value="Atualizar Cadastro" name="enviar">
</pre>
</form>
</body>
</html>