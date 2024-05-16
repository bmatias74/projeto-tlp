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

</head >
<body >
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
        
            <a href="#"><img  class="logo" src="logo.png" alt=""></a>
        
          <h1>  <?= $nomeRestaurante  ?></h1>
            <div class="search-box">
                  <input class="search-text" type="text" id="searchInput" placeholder="Pesquise aqui">
                <a id="erasebtn" href="#"><img src="IMG/bxs-eraser.svg" alt=""></a>
              <a class="search-btn" id="searchbtn" href="#">
                
                      <img src="IMG/loupe-svgrepo-com.svg" alt="lupa" height="19" width="19">
              </a>
          </div>
         
   
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
  <h1>arroz</h1>
  <!-- SLIDER INICIO-->
  <div class="slider">
      <div class="slides">
          <!-- RADIO INICIO-->
        <input type="radio" id="slide-btn-radio" name="radio1">
        <input type="radio" id="slide-btn-radio" name="radio2">
        <input type="radio" id="slide-btn-radio" name="radio3">
        <input type="radio" id="slide-btn-radio" name="radio4">
        <!-- RADIO FIM-->
         <!-- IMAGENS INICIO-->
         <div class="imagemr">
               <img src="IMG_restaurante/Alimilton-2024.04.13-04.46.05pm-image.jpeg" alt="">
         </div>
         <div class="imagemr">
               <img src="IMG_restaurante/Alimilton-2024.04.13-04.46.05pm-image2.jpg" alt="">
         </div>
         <div class="imagemr">
               <img src="IMG_restaurante/Alimilton-2024.04.13-04.46.05pm-image3.jpg" alt="">
         </div>
         <div class="imagemr">
               <img src="IMG_restaurante/Alimilton-2024.04.13-04.46.05pm-image4.jpg" alt="">
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
              <LABEL for="radio1" class="manual-btn"></LABEL>
              <LABEL for="radio2" class="manual-btn"></LABEL>
              <LABEL for="radio3" class="manual-btn"></LABEL>
              <LABEL for="radio4" class="manual-btn"></LABEL>
          </div>
         <!--  NAVEGAÇÃO MANUAL FIM -->
  </div>
   <!-- SLIDER FIM-->
  <article>
  <!-- PHP INICIO-->
  <?php

$idrestaurante =  mysqli_real_escape_string($conexao, $_GET["id"]);
$query = "SELECT * FROM restaurante where id_restaurante = {$idrestaurante}"; // Consulta para buscar as imagens
$result = mysqli_query($conexao, $query);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="imagens">';

    while ($row = mysqli_fetch_assoc($result)) {
        $imageUrl = $row['imagem_p']; // Caminho da imagem
        $nomeRestaurante = $row['nome']; // Nome do restaurante
       $descricao = $row['descricao']; // desecricao do restaurante
       $loc_web = $row['web_loc']; // embebed do google maps
        // HTML para cada restaurante
        echo '<div class="co">';
        echo "<a href=''><img src='IMG_restaurante/$imageUrl' alt='Restaurante $nomeRestaurante'></a>";
        echo "<figcaption for='text'> $nomeRestaurante</figcaption>";
        echo '</div>';
    }

    echo '</div>';
   
   
} else {
    echo "<p>Nenhuma imagem encontrada.</p>";
}
echo '<div class="map">';
echo "$loc_web ";
echo '</div>';
mysqli_close($conexao); // Fecha a conexão com o banco de dados
?>

<!-- PHP FIM-->
  </article>
 
 </main>
 <footer>
<p>Site criado por <strong>Tchibiye</strong></p>
 </footer>

</body>
</html>