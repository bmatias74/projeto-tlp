<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once("db/conexao.php");

    $email = $_POST["email"];
    $password = $_POST["senha"];

    $result = mysqli_query($conexao, "SELECT * FROM adm WHERE email='$email'");

	if ($result) {
        if ($row = mysqli_fetch_assoc($result)) {
            
            if (password_verify($password, $row["senha"])) {

                session_start();
                $_SESSION['email'] = $email; 

                header("Location: ADM.php");
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinica IPPS - Painel Administrativo</title>
    <link rel="stylesheet" href="css\style2.css">
</head>

<body>

<section>
        <form action="admlogin.php" method="post" class="input-box">

        <h1>Login admnistrativo</h1>

<input type="email" name="email" id="" placeholder="Email" required>
<input type="password" name="senha" id="" placeholder="Senha" required>
<div class="login-button">
<button type="submit" style="height: 6vh; background-color:greenyellow;">Entrar</button>
</div>

        </form>
</body>

</section>
</html>
