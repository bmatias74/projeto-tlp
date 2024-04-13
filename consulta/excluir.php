<header>
    <h2>Excluir</h2>
</header>
<?php

$idtchibiye =  mysqli_real_escape_string($conexao, $_GET["idpaciente"]);
$sql= "DELETE FROM tbpaciente WHERE ID_Paciente= {$idtchibiye}"; 
$resultado = mysqli_query($conexao,$sql) or die("Erro ao recuperar os dados.". mysqli_error($conexao));
header("Location: ADM.php?menuop=consulta");
echo "mambo bem eliminado";


?>