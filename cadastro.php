<?php
    session_start(); // Inicia a sessão
include('db/conexao.php');



if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (isset($_POST["Nome"], $_POST["Email"], $_POST["telefone"], $_POST["datadenascimento"], $_POST["criarsenha"], $_POST["confirmarsenha"])) {
        $nome = mysqli_real_escape_string($conexao, $_POST["Nome"]);
        $email = mysqli_real_escape_string($conexao, $_POST["Email"]);
        $telefone = mysqli_real_escape_string($conexao, $_POST["telefone"]);
        $datadenascimento = mysqli_real_escape_string($conexao, $_POST["datadenascimento"]);

        function emailExists($conexao, $email) {
            $query = "SELECT TABLE_NAME
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE COLUMN_NAME = 'email'
            AND TABLE_SCHEMA = 'bdcokulimer';";
        
    $tables = [];
    if ($result = $conexao->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $tables[] = $row['TABLE_NAME'];
        }
    }

    // Verificar se o email existe em alguma das tabelas
    foreach ($tables as $table) {
        $query = "SELECT 1 FROM $table WHERE email = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        }
    }
    return false;
}
        if (emailExists($conexao, $email) ) {
            $_SESSION['message'] = ' <br> Este email já está registrado em nossos sistemas.';
            header("Location: ./cadastramento.php");
            exit();
        } else {
            if ($_POST["criarsenha"] === $_POST["confirmarsenha"]) {
                // Hash the password
                $password = password_hash($_POST["confirmarsenha"], PASSWORD_DEFAULT);
    
                
                 $sql = "INSERT INTO usuario (nome, email, telefone, datadenascimento, senha) VALUES (?, ?, ?, ?, ?)";
                 $stmt = mysqli_prepare($conexao, $sql);
                 mysqli_stmt_bind_param($stmt, "sssss", $nome, $email, $telefone, $datadenascimento, $password);
                 mysqli_stmt_execute($stmt);
    
        
                 if (mysqli_stmt_affected_rows($stmt) > 0) {
                    echo "Sucesso";
                    header("Location: index.php");
                        exit();
                 } else {
                    echo "Erro: " . mysqli_stmt_error($stmt);
                 }
                 mysqli_stmt_close($stmt);
            } else {
                echo "Palavras passes diferentes.";
            }
        }
        
      
    } else {
        echo "Preencha todos os campos.";
    }
} else {
    echo "Método inválido.";
}

mysqli_close($conexao);
header("Location: index.php");
exit();

?>
