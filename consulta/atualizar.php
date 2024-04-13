<?php
 $Nome = mysqli_real_escape_string($conexao,$_POST ["Nome"]) ;
 $idtchibiye =  mysqli_real_escape_string($conexao, $_POST["ID_paciente"]);
 $Numero = mysqli_real_escape_string($conexao,$_POST ["numero"]) ;
 $Genero = mysqli_real_escape_string($conexao,$_POST ["Genero"]) ;
$emai = mysqli_real_escape_string($conexao,$_POST ["Email"]) ;
$tipoc = mysqli_real_escape_string($conexao,$_POST ["Tipo_consulta"]) ;
$data = mysqli_real_escape_string($conexao,$_POST ["data_da_consulta"]) ;
$seguro = mysqli_real_escape_string($conexao,$_POST ["asseguradora"]) ;
$id_m = mysqli_real_escape_string($conexao,$_POST ["Id_medico"]) ;

 $stmt = $conexao-> prepare ( "UPDATE tbpaciente SET 
 Nome = ? , telefone = ? , Sexo = ? , email = ? , data_da_consulta = ? , Tipo_consulta = ? , asseguradora = ?, id_medico = ?
 WHERE ID_Paciente = ?");
$stmt ->bind_param("sssssssii", $Nome, $Numero,$Genero,$email,$data,$tipoc,$seguro,$id_m,$idtchibiye);
$stmt->execute();
echo "Dados atualizados com sucesso";
header("Location: ADM.php?menuop=consulta");
?>