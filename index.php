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
    <link rel="shortcut icon" href="logo.ico" type="image/x-icon">

</head >
<body >
   
      <div class="header">
        <header>
        
            <a href="#"><img  class="logo" src="logo.png" alt=""></a>
        
          <h1> Site</h1>
            <div class="search-box">
                  <input class="search-text" type="text" id="searchInput" placeholder="Pesquise aqui">
                  <p id="">limpar</p>
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
            <li><a href="#">Notificações</a></li>
            <li><a href="#">Privacidade</a></li>
            <li><a href="#">Ajuda</a></li>
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
            <li><a href="#">Home</a></li>
            <li><a href="#">Fale Conosco</a></li>
          </ul>
            </nav>
      </div>
 <main>
  <h1>arroz</h1>
  <article>
  
  <?php


$query = "SELECT nome, imagem_p FROM restaurante"; // Consulta para buscar as imagens
$result = mysqli_query($conexao, $query);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="imagens">';

    while ($row = mysqli_fetch_assoc($result)) {
        $imageUrl = $row['imagem_p']; // Caminho da imagem
        $nomeRestaurante = $row['nome']; // Nome do restaurante

        // HTML para cada restaurante
        echo '<div class="co">';
        echo "<a href=''><img src='IMG_restaurante/$imageUrl' alt='Restaurante $nomeRestaurante'></a>";
        echo "<figcaption for='text'> $nomeRestaurante</figcaption>";
        echo '</div>';
    }

    echo '</div>';
    echo '<div id="pagination-container"></div>';
} else {
    echo "<p>Nenhuma imagem encontrada.</p>";
}

mysqli_close($conexao); // Fecha a conexão com o banco de dados
?>

  </article>
   
 </main>
 <footer>
<p>Site criado por <strong>Tchibiye</strong></p>
 </footer>
 <script src="JS/principal.js"></script>
</body>
</html>