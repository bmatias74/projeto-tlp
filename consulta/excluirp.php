<header>
    <h2>Excluir</h2>
</header>
<?php 

 
$idtchibiye =  mysqli_real_escape_string($conexao, $_GET["idusuario"]);
 $sql= "DELETE FROM usuario WHERE id= {$idtchibiye}"; 
                    $resultado = mysqli_query($conexao,$sql) or die("Erro ao recuperar os dados.". mysqli_error($conexao));
                  

    header("Location: adm.php?menuop=home");
    echo "mambo bem eliminado";
            exit;

?>