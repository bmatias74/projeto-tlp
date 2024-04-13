<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   

    include_once('db\conexao.php');

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $password = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    // verfocar se o usuário ou e-mail já existem
    $result = mysqli_query($conexao, "SELECT * FROM adm WHERE telefone='$telefone' OR email='$email'");

    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            // user ou e-mail já existem
            echo "<script>alert('Log já existente!');</script>";

        } else {
            $sql = "INSERT INTO adm (nome,email,telefone,senha) VALUES ('$nome','$email','$telefone','$password')";


    if (mysqli_query($conexao, $sql)) {
        echo "<script>alert('Registro realizado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro no registro! " . mysqli_error($conexao) . "');</script>";
    }

    // Fechar a conexão
    $conexao->close();
}
    }
}
exit();
header("index.php");
    
?>
