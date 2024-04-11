<?php 
include('db/conexao.php');
$nome = mysqli_real_escape_string($conexao, $_POST["Nome"]);
$email= mysqli_real_escape_string($conexao, $_POST["Email"]);
$
?>
