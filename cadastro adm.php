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

    
?>





<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="CSS/Login1.CSS">
    <link rel="shortcut icon" href="logo.ico" type="image/x-icon">
</head>
<body >
   
 
      <header>
          <a href="index.htm"><img  class="logo" src="logo.png" alt=""></a>
        <h1> Cadastro do Adm</h1>
      </header>

<main>


   
<section class="formulario">
<h1>Olá, efectute já o seu cadastro de administrador</h1>
    <hr>
<form action="cadastro adm(tela temporaria).php" method="POST" >
<h1>Cadastrar admnistrador</h1>

<div class="inputg">
     <!-- Nome--> 
    <label for="nome"> Nome</label>
    <input type="text" name="nome" placeholder="Nome" required>
     <!-- email--> 
    <label for="email"> E-mail</label>
    <input type="email" name="email" id="" placeholder="Email" required>
     <!-- telefone--> 
    <label for="telefone"> Telefone</label>
    <input type="telephone" name="telefone" id="telefone" placeholder="Telefone" required maxlength="9">
    <small id="telefone-error" style=" display: none;">O número de telefone deve ter exatamente 9 dígitos.</small>
     <!-- palavra passe--> 
     <label for="password"> Senha</label>
    <input type="password" name="senha" id="" placeholder="Senha" required>
</div>
<div class="login-button">
<button type="submit">Cadastrar</button>
</div>


</form>





</section>
</main>
<footer>
<p>Site criado por <strong>Tchibiye</strong></p>
</footer>
<script>
      const inputtelefone= document.getElementById('telefone');
      const telefoneError = document.getElementById('telefone-error');
      inputtelefone.addEventListener('input', function (){
        const telefone = this.value.trim();
        if (telefone.length !== 9 || !/^\d+$/.test(telefone)) {
            telefoneError.style.display = 'block';
        } else {
            telefoneError.style.display = 'none';
        }
      }
       )
     </script>
</body>
</html>