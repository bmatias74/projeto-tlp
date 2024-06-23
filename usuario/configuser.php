<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../db/conexao.php");


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
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração</title>
    <link rel="stylesheet" href="../CSS\configuser.css">
    <link rel="shortcut icon" href="../logo.ico" type="image/x-icon">
<style>
       .logado {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-weight: 700;
    font-size: 2rem;
    justify-content: center;
    align-items: center;
}

.logado::after {
    content: "\1F62D";

}
    </style>
</style>
</head>
<?php 
// Checagem
if (!$logado) {
    echo '  <a href="#">
                    <img class="btn_fechar" onclick="sair()" src="../Imagens/icons/close-circle-svgrepo-com.svg" alt="fechar">
                </a>';
    echo ' <script>
        function sair() {
            window.location.href = "../index.php";
        }
    </script>';
    echo ' <h1 class="logado" style =  "color:black">
    Precisas estar logado
    </h1>
    ';
    exit;
}
?>
<body>

    <nav>

        <ul>
            <li>
                <a href="#">
                    <img class="btn_fechar" onclick="sair()" src="../Imagens/icons/close-circle-svgrepo-com.svg" alt="fechar">
                </a>
            </li>
            <li>
                <p><a class="a_nav " href="?menuop=perfil">Perfil</a></p>
            </li>
            <li>
                <p><a class="a_nav " href="?menuop=favoritos">Favoritados</a></p>
            </li>
            <li>
                <p><a class="a_nav " href="../logout.php">Terminar sessão</a></p>
            </li>

        </ul>
    </nav>
    <div class="container">
        <?php

        $menuop = (isset($_GET["menuop"])) ? $_GET["menuop"] : 'perfil';
        switch ($menuop) {
            case 'perfil':
                include("../usuario/perfil.php");
                break;
            case 'favoritos':
                include("../usuario/favoritados.php");
                break;
            default;
                include("../usuario/perfil.php");
        }


        ?>
    </div>
    <script>
        function sair() {
            window.location.href = "../index.php";
        }
    </script>
</body>

</html>