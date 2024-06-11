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
<div class="header">
    <header>

      <a href="index.php"><img class="logo" src="logo.png" alt=""></a>

      <h1 id="tituloh"> KINO</h1>
      <div class="search-box">
        <input class="search-text" type="text" id="searchInput" placeholder="Pesquise aqui">
        <a id="erasebtn" href="#"><img src="IMG/bxs-eraser.svg" alt=""></a>
        <a class="search-btn" id="searchbtn">

          <img src="IMG/loupe-svgrepo-com.svg" alt="lupa" height="19" width="19">
        </a>
      </div>


      <div class="placa_boa">
        <?php if ($logado) : ?>
          <p>Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?></p>
        <?php else : ?>
          <p>Olá, visitante!</p>
        <?php endif; ?>
      </div>
      <?php if ($logado) : ?>
        <button id="settingsBtn" class="menu-btn"><img src="IMG/gear-svgrepo-com.svg" alt="engrenagem" height="19" width="19"></button>
        <div id="settingsMenu" class="settings-menu hidden">
          <ul>
            <li><a href="#">Perfil</a></li>
            <li><a href="logout.php">Sair</a></li>
          </ul>
        </div>
      <?php else : ?>
        <p class="button"> <a href="cadastramento.php">Cadastre-se</a> </p>
        <p class="button"><a href="login.php">Login</a></p>
      <?php endif; ?>
    </header>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
   
      </ul>
    </nav>
  </div>