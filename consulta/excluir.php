<header>
    <h2>Excluir</h2>
</header>
<?php

$idtchibiye =  mysqli_real_escape_string($conexao, $_GET["idrestaurante"]);
$sql= "DELETE FROM restaurante WHERE id= {$idtchibiye}"; 
$resultado = mysqli_query($conexao,$sql) or die("Erro ao recuperar os dados.". mysqli_error($conexao));
header("Location: adm.php?menuop=consulta");
echo "mambo bem eliminado";


?>