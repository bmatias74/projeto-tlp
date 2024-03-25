<?php 
  include("config.php");
  date_default_timezone_set('Africa/Angola');
  $conexao = mysqli_connect(SERVIDOR,USER,SENHA,BD) or die("ERRO NA CONEXÃO". mysqli_connect_error());
    
?>