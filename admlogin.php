<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once("db/conexao.php");

    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($conexao, "SELECT * FROM adm WHERE email='$email'");

    if ($result) {
        if ($row = mysqli_fetch_assoc($result)) {

            if (password_verify($password, $row["senha"])) {

                session_start();
                $_SESSION['email'] = $email;

                header("Location: adm.php");
                exit();
            } else {

                echo "<script>alert('Senha incorreta!');</script>";
            }
        } else {
            echo "<script>alert('Usuario não identificado');</script>";
        }
    } else {
        echo "<script>alert('Erro na consulta: " . mysqli_error($conexao) . "');</script>";
    }

    $conexao->close();
}
?>



<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="CSS/Login.CSS">
    <link rel="shortcut icon" href="logo.ico" type="image/x-icon">
</head>

<body>


    <header>
        <a href="index.php"><img class="logo" src="logo.png" alt=""></a>
        <h1> Site</h1>
    </header>

    <main>


        <div class="formulario">
            <h1>Olá, que saudades</h1>
            <hr>
            <form action="admlogin.php" method="post">
                <div class="inputg">
                    <label for="email"> E-mail/Nome de usuário</label>
                    <input type="text" name="email" id="email" placeholder="Introduza o E-mail ou o nome de usuário" required>

                    <label for="password"> Palavra-passe</label>
                    <input type="password" name="password" id="password" placeholder="Insira a sua palavra-passe" required>
                </div>

                <button type="submit"> Entrar</button>
                <p> Não possuis conta? <a href="tela de cadastramento adm.php">Cadastre-se</a>
            </form>
        </div>
    </main>
    <footer>
        <p>Site criado por <strong>Tchibiye</strong></p>
    </footer>

</body>

</html>