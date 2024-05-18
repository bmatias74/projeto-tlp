<?php
session_start();
    include("db/conexao.php");
 

    $logado  = false;

    if (isset($_SESSION['emailu'])) {
      $email = $_SESSION['emailu'];
      $logado = true;
      $email = $_SESSION['emailu'];
    }
    // Preparar a consulta
    $stmt = $conexao->prepare("SELECT nome FROM usuario WHERE email=?");

    // Vincular o parâmetro de e-mail
    $stmt->bind_param("s", $email);

    // Executar a consulta
    $stmt->execute();

    // Vincular a variável de resultado
    $stmt->bind_result($nome);

    // Buscar o resultado
    $stmt->fetch();

    // Fechar a consulta
    $stmt->close();

    // Agora, $nome contém o nome do administrador com o e-mail fornecido

    $_SESSION['nome']=$nome;

?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KINO</title>
    
    <link rel="stylesheet" href="CSS/Style.CSS">
    <link rel="stylesheet" href="CSS/configstyle.css">
    <link rel="stylesheet" href="CSS/restaurante.css">
    
    <link rel="shortcut icon" href="logo.ico" type="image/x-icon">

</head>
<body>
<?php 
  
  $idrestaurante =  mysqli_real_escape_string($conexao, $_GET["id"]);
  $query = "SELECT * FROM restaurante where id_restaurante = {$idrestaurante}"; // Consulta para buscar as imagens
  $result = mysqli_query($conexao, $query);
  
  if (mysqli_num_rows($result) > 0) {
   
  
      while ($row = mysqli_fetch_assoc($result)) {
          $imageUrl = $row['imagem_p']; // Caminho da imagem
          $nomeRestaurante = $row['nome']; // Nome do restaurante
         $descricao = $row['descricao']; // desecricao do restaurante
      
  
      }
      
  } else {
   
  }
     
     
     ?>
     <div class="header">
        <header>
        
            <a href="index.php"><img  class="logo" src="logo.png" alt=""></a>
        
          <h1>  <?= $nomeRestaurante  ?></h1>
           
         
   
          <div class="placa_boa">
         <?php if ($logado): ?>
        <p>Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?></p>
    <?php else: ?>
        <p>Olá, visitante!</p>
    <?php endif; ?>
      </div>
      <?php if ($logado): ?>
      <button id="settingsBtn" class="menu-btn"><img src="IMG/gear-svgrepo-com.svg" alt="engrenagem" height="19" width="19"></button>
    <div id="settingsMenu" class="settings-menu hidden">
        <ul>
            <li><a href="#">Perfil</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </div>
    <?php else: ?>
    <p class="button"> <a href="cadastramento.php">Cadastre-se</a> </p>
    <p class="button"><a href="login.php">Login</a></p>
    <?php endif; ?>  
        </header>
         <nav>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Fale Conosco</a></li>
          </ul>
            </nav>
      </div>
 <main>
   <!-- PHP INICIO-->
   <?php

$idrestaurante =  mysqli_real_escape_string($conexao, $_GET["id"]);
$query = "SELECT * FROM restaurante where id_restaurante = {$idrestaurante}"; // Consulta para buscar as imagens
$result = mysqli_query($conexao, $query);

if (mysqli_num_rows($result) > 0) {
 

    while ($row = mysqli_fetch_assoc($result)) {
        $imageUrl = $row['imagem_p']; // Caminho da imagem
        $nomeRestaurante = $row['nome']; // Nome do restaurante
       $descricao = $row['descricao']; // desecricao do restaurante
       $imagem1 = $row['imagem_s1']; // imagem 1 do restaurante
       $imagem2 = $row['imagem_s2']; // imagem 2 do restaurante
       $imagem3 = $row['imagem_s3']; // imagem 3 do restaurante
       $imagem4 = $row['imagem_s4']; // imagem 4 do restaurante
       $loc_web = $row['web_loc']; // embebed do google maps
      
    }

   
   
   
} else {
    echo "<p>Nenhuma imagem encontrada.</p>";
}

mysqli_close($conexao); // Fecha a conexão com o banco de dados
?>
<img class="imagem_p" src="IMG_restaurante/<?= $imageUrl ?>" alt="">

<!-- PHP FIM-->
 
  <!-- SLIDER INICIO-->
  <div class="slider">
      <div class="slides">
          <!-- RADIO INICIO-->
        <input type="radio" id="radio1" name="radio-btn">
        <input type="radio" id="radio2" name="radio-btn">
        <input type="radio" id="radio3" name="radio-btn">
        <input type="radio" id="radio4" name="radio-btn">
        <!-- RADIO FIM-->
         <!-- IMAGENS INICIO-->
         <div class="slide" id="imagem1">
               <img src="IMG_restaurante/<?= $imagem1 ?>" alt="">
         </div>
         <div class="slide" id="imagem2">
               <img src="IMG_restaurante/<?= $imagem2 ?>" alt="">
         </div>
         <div class="slide" id="imagem3">
               <img src="IMG_restaurante/<?= $imagem3 ?>" alt="">
         </div>
         <div class="slide" id="imagem4">
               <img src="IMG_restaurante/<?= $imagem4 ?>" alt="">
         </div>
         <!-- NAVEGAÇÂO AUTOMÁTICA INICIO -->
         <div class="navega-auto">
              <div class="auto-btn1"></div>
              <div class="auto-btn2"></div>
              <div class="auto-btn3"></div>
              <div class="auto-btn4"></div>
         </div>
         <!-- NAVEGAÇÃO AUTOMÁTICA FIM -->
      </div>
          <!-- NAVEGAÇÃO MANUAL INICIO -->
          <div class="navega-mano">
              <label for="radio1" class="manual-btn"></label>
              <label for="radio2" class="manual-btn"></label>
              <label for="radio3" class="manual-btn"></label>
              <label for="radio4" class="manual-btn"></label>
          </div>
         <!--  NAVEGAÇÃO MANUAL FIM -->
  </div>
   <!-- SLIDER FIM-->
 </main>
 
 <script src="slide.js">
</script>
</body>
</html>
