<?php 
  include("config.php");
  $conexao = mysqli_connect(SERVIDOR,USER,SENHA,BD) or die("ERRO NA CONEXÃO". mysqli_connect_error());
    
?>