<?php

// Prepare the statement
$stmt = $conexao->prepare("SELECT * FROM adm WHERE email = ?");
// Bind the email parameter
$stmt->bind_param("s", $email);
// Execute the statement
$stmt->execute();
// Get the result of the statement
$result = $stmt->get_result();
// Fetch the associative array from result
$linha = $result->fetch_assoc();



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Update Image Profile</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./CSS/styler1.CSS">
</head>

<body>
  <main>
    <form class="formulario" id="formulario" action="ADM/atualizaradm.php" enctype="multipart/form-data" method="post">
      <!-- foto principal-->
      <div class="upload">
        <?php

        $image = $linha["imagem_p"];
        ?>
        <div class="perfil">
          <img src="IMG_adm/<?php echo $image; ?>" width=125 height=125 title="<?php echo $image; ?> " id="imagePreview">
          <div class="round">

            <input type="file" name="image" id="imageInput" accept=".jpg, .jpeg, .png">
            <i class="fa fa-camera" style="color: #fff;"></i>
          </div>
        </div>
      </div>

      <div class="inputg">
        <!-- ID-->
        <div class="input-box">
          <label for="IDAdm">ID</label><!--1-->
          <input type="text" name="id" readonly value="<?= $linha["id"] ?>">
        </div>
        <!-- Nome-->
        <div>
          <label for="nome"> Nome</label>
          <input type="text" name="nome" placeholder="Nome" value="<?= $linha["nome"] ?>">
        </div>
        <!-- email-->
        <div>
          <label for="email"> E-mail</label>
          <input type="email" name="email" id="" placeholder="Email" value="<?= $linha["email"] ?>">
        </div>
        <!-- telefone-->
        <div>
          <label for="telefone"> Telefone</label>
          <input type="telephone" name="telefone" id="telefone" placeholder="Telefone" maxlength="9" value="<?= $linha["telefone"] ?>">
          <small id="telefone-error" style=" display: none;">O número de telefone deve ter exatamente 9 dígitos.</small>
        </div>
        <!-- palavra passe-->
        <div>
          <label for="password"> Senha</label>
          <input type="password" name="senha" id="" placeholder="Senha">
        </div>
      </div>

      <br>


      <button type="submit"> Inserir</button>
    </form>



    <script>
      // Função para atualizar o preview da imagem
      function updateImagePreview(inputId, imgPreviewId) {
        var input = document.getElementById(inputId);
        var imgPreview = document.getElementById(imgPreviewId);

        input.addEventListener('change', function() {
          const file = this.files[0];
          if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
              imgPreview.setAttribute('src', event.target.result);
            };
            reader.readAsDataURL(file);
          }
        });
      }

      // Inicializa os listeners para cada par de input e imagem
      updateImagePreview('imageInput', 'imagePreview');
    </script>
    <script>
      const inputtelefone = document.getElementById('telefone');
      const telefoneError = document.getElementById('telefone-error');
      inputtelefone.addEventListener('input', function() {
        const telefone = this.value.trim();
        if (telefone.length !== 9 || !/^\d+$/.test(telefone)) {
          telefoneError.style.display = 'block';
        } else {
          telefoneError.style.display = 'none';
        }
      })
      const inputtelefone2 = document.getElementById('telefone2');
      const telefoneError2 = document.getElementById('telefone-error2');

      inputtelefone2.addEventListener('input', function() {
        const telefone2 = this.value.trim();
        if (telefone2.length !== 9 || !/^\d+$/.test(telefone2)) {
          telefoneError2.style.display = 'block';
        } else {
          telefoneError2.style.display = 'none';
        }
      })
    </script>

  </main>
</body>

</html>