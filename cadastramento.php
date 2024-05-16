<?php
    session_start(); // Inicia a sessão
    include("db/conexao.php");


    function msg() {
      if (isset($_SESSION['message'])) {
          echo "<p style='color:red'>" . $_SESSION['message'] . "</p>";
          unset($_SESSION['message']); // Limpa a mensagem após exibição
      }
  }
  


?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link rel="stylesheet" href="CSS/Login1.CSS">
  <link rel="shortcut icon" href="logo.ico" type="image/x-icon">
</head>
<body>
  <header>
    <a href="index.php"><img class="logo" src="logo.png" alt=""></a>
    <h1>Cadastro</h1>
  </header>
  <main>
    <div class="formulario">
      <h1>Seja bem-vindo, efectue já o seu registo</h1>
      <hr>
      <form action="cadastro.php" method="post">
        <div class="inputg">
          <!-- Nome -->
          <label for="nome">Nome<span class="obrigatorio">*</span></label>
          <input type="text" placeholder="Insira o nome completo" name="Nome" required>
          <!-- Email -->
          <label for="email">Email<span class="obrigatorio">*</span></label>
          <input type="email" placeholder="Insira o email" name="Email" required>
          <!-- Telefone -->
          <label for="telefone">Telefone<span class="obrigatorio">*</span></label>
          <input type="telephone" placeholder="Insira o número de telefone" name="telefone" id="telefone" pattern="\d{9}" maxlength="9" required>
          <small id="telefone-error" style="color: red; display: none;">O número de telefone deve ter exatamente 9 dígitos.</small>
          <!-- Data de nascimento -->
          <label for="data">Data de nascimento<span class="obrigatorio">*</span></label>
          <input type="date" id="datadenascimento" name="datadenascimento">
          <!-- Senha -->
          <label for="senha">Criar senha<span class="obrigatorio">*</span></label>
          <input type="password" name="criarsenha" id="senha" placeholder="Digite a senha" required>
          <!-- Confirmar a senha -->
          <label for="csenha">Confirmar senha<span class="obrigatorio">*</span></label>
          <input type="password" placeholder="Repita a senha" name="confirmarsenha" id="csenha" required>
          <small id="senha-error" style="color: red; display: none;">As senhas devem ser iguais.</small>
        </div>
        <?php 
            msg();
        ?>
        <button name="cadastrar" id="btn-entrada" disabled>Cadastrar</button>
        <p>Já tem conta? <a href="login.php">Iniciar Sessão</a></p>
      </form>
    </div>
  </main>
  <footer>
    <p>Site criado por <strong>Tchibiye</strong></p>
  </footer>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const inputTelefone = document.getElementById('telefone');
      const telefoneError = document.getElementById('telefone-error');
      const inputSenha = document.getElementById('senha');
      const inputCSenha = document.getElementById('csenha');
      const senhaError = document.getElementById('senha-error');
      const btnEntrada = document.getElementById('btn-entrada');

      inputTelefone.addEventListener('input', function() {
        const telefone = this.value.trim();
        if (telefone.length !== 9 || !/^\d+$/.test(telefone)) {
          telefoneError.style.display = 'block';
          btnEntrada.disabled = true;
        } else {
          telefoneError.style.display = 'none';
          btnEntrada.disabled = false;
        }
      });

      function validatePasswords() {
        if (inputSenha.value !== inputCSenha.value) {
          senhaError.style.display = 'block';
          btnEntrada.disabled = true;
        } else {
          senhaError.style.display = 'none';
          if (telefoneError.style.display === 'none') {
            btnEntrada.disabled = false;
          }
        }
      }

      inputSenha.addEventListener('input', validatePasswords);
      inputCSenha.addEventListener('input', validatePasswords);
    });
  </script>
</body>
</html>
