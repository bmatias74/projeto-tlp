
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href=".\CSS\painel-consulta.css">
</head>
<body>
<header>
    <h3>Configurações</h3>
    <hr>
</header>
<div>

<form action="adm.php?menuop=consula&home" method="post">
    <input type="text" placeholder="Quantos elementos serão exibidos?" style="width: 37vmin;" name="muntchiya">
    <input type="submit" value="salvar">
</form>

</div>
<?php
$qtd = isset($_SESSION['muntchiya']) ? $_SESSION['muntchiya'] : 10;
$sqltotal = "SELECT * FROM restaurante";
$qr= mysqli_query($conexao,$sqltotal) or die  (mysqli_error($conexao));
$numt = mysqli_num_rows($qr);

$totalpg = ceil($numt/$qtd);

$sqltotalc = "SELECT * FROM usuario";
$qrc= mysqli_query($conexao,$sqltotalc) or die  (mysqli_error($conexao));
$numtc = mysqli_num_rows($qrc);

$totalpgc = ceil($numtc/$qtd);


echo "<table border='1'>"; 
echo "<thead>
    <tr><th>Descrição</th><th>Total Páginas</th><th>Total de Registros</th></tr>
</thead>";


echo "<tr>";
echo "<td class=\"tcabeca\">Total  de restaurante</td>";
echo "<td>$totalpg</td>";
echo "<td>$numt</td>";
echo "</tr>";


echo "<tr>";
echo "<td class=\"tcabeca\">Total  de usuarios</td>";
echo "<td>$totalpgc</td>";
echo "<td>$numtc</td>";
echo "</tr>";


echo "</table>";
?> 
<br>
<div class="inputg">
    <a href="adm.php?menuop=editaradm" class="button">Editar dados do Administrador</a>
    <a href="adm.php?menuop=insrrestaurante" class="button">Inserir restaurante</a>
</div>
</body>
</html>


