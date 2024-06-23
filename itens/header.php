<?php
session_start();
include("db/conexao.php");


$logado  = false;
$se_logou = 'nlogado';
if (isset($_SESSION['emailu'])) {
  $email = $_SESSION['emailu'];
  $logado = true;
  $se_logou = 'logado';
  $email = $_SESSION['emailu'];
}
//Pegar o nome
$stmt = $conexao->prepare("SELECT nome FROM usuario WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($nome);
$stmt->fetch();
$stmt->close();
$_SESSION['nome'] = $nome;

// Pegar o id
$stmti = $conexao->prepare("SELECT id FROM usuario WHERE email=?");
$stmti->bind_param("s", $email);
$stmti->execute();
$stmti->bind_result($id);
$stmti->fetch();
$stmti->close();
$_SESSION['id'] = $id;

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
          <li><a href="usuario\configuser.php">Configurações</a></li>
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
<script src="JS/principal.js"></script>