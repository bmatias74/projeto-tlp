<?php
include("db/conexao.php");
include('auth.php');

verificarSessao();

$email = $_SESSION['email'];

// Preparar a consulta
$stmt = $conexao->prepare("SELECT nome FROM adm WHERE email=?");

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

$_SESSION['nome'] = $nome;

?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="shortcut icon" href="logo.ico" type="image/x-icon">
  <link rel="stylesheet" href="./CSS/adm.css" />
  <title>ADM</title>
</head>

<body>

  <div class="sidebar">
    <div class="top">
      <div class="logo">
        <img src="logo.png" alt="" width="25px" />
        <span>Cokulimer</span>
      </div>
      <i class="bx bx-menu" id="btn"></i>
    </div>
    <div class="perfil">
      <?php

      $stmti = $conexao->prepare("SELECT nome, imagem_p FROM adm WHERE email = ?");
      $stmti->bind_param("s", $email);
      $stmti->execute();
      $resulti = $stmti->get_result();

      if ($resulti->num_rows > 0) {
        $row = $resulti->fetch_assoc();
        $imageUrl = $row['imagem_p']; // Path to the image
        $nomeAdm = $row['nome']; // Name of the administrator

        // Generate HTML for the administrator's image
        echo '<div class="user-img">';
        echo "<img src='IMG_adm/$imageUrl' alt='Administrador $nomeAdm' />";
        echo '</div>';
      } else {
        // Display default image if no records found
        echo "<img src='IMG/usuario_318-134392.jpg' alt='Imagem padrão' class='user-img' />";
      }

      $stmti->close();
      ?>




      <div>
        <p class="bold">Administrador</p>
        <p><?php echo $_SESSION['nome'] ?></p>
      </div>
    </div>

    <ul>
      <li>
        <a href="adm.php?menuop=home"> <!--variavel ou paramentro para fazer atroca -->
          <i class='bx bx-home-alt-2' style='color:#ece8e8'></i>
          <span class="nav-item">Usuários</span>
        </a>
        <span class="tooltip">Usuários</span> <!-- vai server quando o menu tiver pic -->
      </li>
      <li>
        <a href="adm.php?menuop=consulta">
          <i class="bx bxs-grid-alt"></i>
          <span class="nav-item">Restaurantes</span>
        </a>
        <span class="tooltip">Restaurante</span> <!-- vai server quando o menu tiver pic -->
      </li>
      <li>
        <a href="adm.php?menuop=config">
          <i class="bx bx-cog"></i>
          <span class="nav-item">Definições</span>
        </a>
        <span class="tooltip">Definições</span> <!-- vai server quando o menu tiver pic -->
      </li>
      <li>
        <a href="admlogout.php?menuop=sair">
          <i class="bx bxs-log-out"></i>
          <span class="nav-item">Sair</span>
        </a>
        <span class="tooltip">Sair</span> <!-- vai server quando o menu tiver pic -->
      </li>
    </ul>
  </div>
  <div class="main-content">
    <div class="container">
      <?php
      $menuop = (isset($_GET["menuop"])) ? $_GET["menuop"] : "consulta";
      switch ($menuop) {
        case 'home':
          include("home/home.php");
          break;
        case 'consulta':
          include("consulta/consulta.php");
          break;
        case 'editar':
          include("consulta/editar.php");
          break;
        case 'atualizar':
          include("consulta/atualizar.php");
          break;
        case 'atualizarr':
          include("consulta/atualizarr.php");
          break;
        case 'excluirp':
          include("consulta/excluirp.php");
          break;
        case 'certeza':
          include("consulta/certeza.php");
          break;
        case 'tenscerteza':
          include("consulta/tenscerteza.php");
          break;
        case 'excluir':
          include("consulta/excluir.php");
          break;

        case 'config':
          include("consulta/configadm.php");
          break;
        case 'editaradm':
          include("ADM/editaradm.php");
          break;
        case 'editar':
          include("home/editar.php");
          break;
        case 'editarr':
          include("consulta/editarr.php");
          break;
        case 'atualizaradm':
          include("ADM/atualizaradm.php");
          break;
        case 'insrrestaurante':

          header("Location:./inserir restaurante.php");
          break;
        default: //caso n tenha nada a escolher ele vai pra home
          include("home/home.php");
          break;
      }
      ?>
    </div>
  </div>
  <script>
    let btn = document.querySelector('#btn')
    let sidebar = document.querySelector('.sidebar')

    btn.onclick = function() {
      sidebar.classList.toggle('active');
    };
  </script>
  <footer>
    <p>Site criado por <strong>Tchibiye</strong></p>
  </footer>
</body>

</html>