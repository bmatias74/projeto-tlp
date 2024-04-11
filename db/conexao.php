<?php 
  include("config.php");
  date_default_timezone_set('Africa/Luanda');
  $conexao = mysqli_connect(SERVIDOR,USER,SENHA,BD) or die("ERRO NA CONEXÃO". mysqli_connect_error());
    
?>