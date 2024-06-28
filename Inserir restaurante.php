<!DOCTYPE html>
<html lang="pt-pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="logo.ico" type="image/x-icon">
  <link rel="shortcut icon" href="logo.ico" type="image/x-icon">
  <link rel="stylesheet" href="CSS/styler.CSS">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="shortcut icon" href="logo.ico" type="image/x-icon">
  <title>Inserir restaurante</title>
</head>

<body>
  <header>
    <a href="index.php"><img class="logo" src="logo.png" alt=""></a>
    <h1> Inserir restaurante</h1>
  </header>
  <main>
    <form class="formulario" id="formulario" action="cadastroRestaurante.php" enctype="multipart/form-data" method="post">
      <!-- foto principal-->
      <div class="upload">


        <img src="logo.png" alt="" width=125 id="imagePreview" height=125>
        <div class="round">
          <input type="file" name="image" id="imageInput" accept=".jpg, .jpeg, .png">
          <i class="fa fa-camera" style="color: #fff;"></i>
        </div>
      </div>


      <div class="inputg">
        <!-- Nome-->
        <div>
          <label for="nome">Nome<span class="obrigatorio">*</span></label>
          <input type="text" placeholder="Insira o nome completo" name="Nome" id="email" required>
        </div>
        <!-- Email-->
        <div>
          <label for="email">Email<span class="obrigatorio">*</span></label>
          <input type="email" placeholder="Insira o email" name="Email" required>
        </div>

        <!-- Telefone-->
        <div>
          <label for="telefone"> Telefone</label>
          <input type="telephone" name="telefone" id="telefone" placeholder="Telefone" required maxlength="9">
          <small id="telefone-error" style=" display: none;">O número de telefone deve ter exatamente 9 dígitos.</small>
        </div>
        <!-- Telefone2-->
        <div>
          <label for="telefone2">Telefone opcional</span></label>
          <input type="telephone" placeholder="Insira o número de telefone" name="telefone2" id="telefone2" maxlength="9">
          <small id="telefone-error2" style="color: red; display: none;">O número de telefone deve ter exatamente 9 dígitos.</small>
        </div>
        <!-- TELEFONE CHECKS-->
        <div class="radios">
          <div class="radio">
            <input value="N/A" type="checkbox" name="contactos" id="telefonec">
            <label for="contactos">Clique aqui se não houver TELEFONE </label>

          </div>

          <div class="radio">
            <input value="N/A" type="checkbox" name="contactos" id="telefone2c">
            <label for="contactos">Cique aqui se não houver Telefone2 </label>
          </div>


        </div>
        <!-- Descrição-->
        <div>
          <label for="data">Descrição</span></label>
          <input type="text" id="descricao" name="descricao" placeholder="Digite uma descrição acerca do restaurante">
        </div>
        <!-- Localização-->
        <div>
          <label for="Localizção web">localização no google maps</label>
          <input type="text" name="localizacao" placeholder="Digite a Localização">
        </div>
        <!-- Morada-->
        <div>
          <label for="Localizção ">localização <span class="obrigatorio">*</span></label>
          <input type="text" name="morada" placeholder="Digite a Localização" required>
        </div>
        <!-- Facebook-->
        <div>
          <label for="facebook">Facebook</label>
          <input type="text" placeholder="Se tiver insira o facebook da empresa" id="facebook"  name="facebook">
        </div>
        <!--instagram -->
        <div>
          <label for="">Instagram</label>
          <input type="text" placeholder="Se tiver insira o instagram da empresa"  id="instagram" name="instagram">
        </div>
        <!-- Twitter-->
        <div>
          <label for="Twitter">Twitter</label>
          <input type="text" placeholder="Se tiver insira o twitter da empresa" id="twitter"  name="twitter">
        </div>
        <!-- Site-->
        <div>
          <label for="Site">Site</label>
          <input type="text" placeholder="Se tiver insira o site da empresa"  id="site"  name="site">
        </div>
      </div>
      </div>
      <div class="radios">
        <div class="radio">
          <input value="N/A" type="checkbox" name="redes" id="twitterc">
          <label for="redes">Clique aqui se não houver twitter</label>

        </div>

        <div class="radio">
          <input value="N/A" type="checkbox" name="redes" id="instagramc">
          <label for="redes">Clique aqui se não houver instagram</label>
        </div>
        <div class="radio">
          <input value="N/A" type="checkbox" name="redes" id="facebookc">
          <label for="redes">Clique aqui se não houver facebook</label>
        </div>
        <div class="radio">
          <input value="N/A" type="checkbox" name="redes" id="sitec">
          <label for="redes">Clique aqui se não houver site</label>
        </div>
        <div class="radio">
          <input value="N/A@gmail.com" type="checkbox" name="redes" id="emailc">
          <label for="redes">Clique aqui se não houver Email</label>
        </div>

      </div>
      <br>
      <div class="muitos_uploads">
        <!-- Image 2-->
        <div class="upload">

          <img src="logo.png" alt="" width=125 height=125 id="imagePreview2">
          <div class="round">

            <input type="file" name="image2" id="imageInput2" accept=".jpg, .jpeg, .png">
            <i class="fa fa-camera" style="color: #fff;"></i>
          </div>
        </div>
        <!-- Image 3-->
        <div class="upload">

          <img src="logo.png" alt="" width=125 height=125 id="imagePreview3">
          <div class="round">

            <input type="file" name="image3" id="imageInput3" accept=".jpg, .jpeg, .png">
            <i class="fa fa-camera" style="color: #fff;"></i>
          </div>
        </div>
        <!-- Image 4-->
        <div class="upload">

          <img src="logo.png" alt="" width=125 height=125 id="imagePreview4">
          <div class="round">

            <input type="file" name="image4" id="imageInput4" accept=".jpg, .jpeg, .png">
            <i class="fa fa-camera" style="color: #fff;"></i>
          </div>
        </div>
        <!-- Image 5-->
        <div class="upload">

          <img src="logo.png" alt="" width=125 height=125 id="imagePreview5">
          <div class="round">

            <input type="file" name="image5" id="imageInput5" accept=".jpg, .jpeg, .png">
            <i class="fa fa-camera" style="color: #fff;"></i>
          </div>
        </div>
      </div>
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
      updateImagePreview('imageInput2', 'imagePreview2');
      updateImagePreview('imageInput3', 'imagePreview3');
      updateImagePreview('imageInput4', 'imagePreview4');
      updateImagePreview('imageInput5', 'imagePreview5');
    </script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const instagram = document.getElementById('instagram');
        const twitter = document.getElementById('twitter');
        const face = document.getElementById('facebook');
        const instagramc = document.getElementById('instagramc');
        const twitterc = document.getElementById('twitterc');
        const site = document.getElementById('site');
        const sitec = document.getElementById('sitec');
        const email = document.getElementById('email');
        const emailc = document.getElementById('emailc');
        const facec = document.getElementById('facebookc');

        instagramc.addEventListener('change', function() {
          if (instagramc.checked) {
            instagram.value = instagramc.value;
          }

        });
        
        emailc.addEventListener('change', function() {
          if (emailc.checked) {
            email.value = emailc.value;
          }

        });
        sitec.addEventListener('change', function() {
          if (sitec.checked) {
            site.value = sitec.value;
          }

        });

        twitterc.addEventListener('change', function() {
          if (twitterc.checked) {
            twitter.value = twitterc.value;
          }
        });

        facec.addEventListener('change', function() {
          if (facec.checked) {
            face.value = facec.value;
          }
        });

        //check do telefone
        const telefone = document.getElementById('telefone');
        const telefone2 = document.getElementById('telefone2');
        const telefonec = document.getElementById('telefonec');
        const telefone2c = document.getElementById('telefone2c');
        telefone2c.addEventListener('change', function() {
          if (telefone2c.checked) {
            telefone2.value = telefone2c.value;
          }

        });

        telefonec.addEventListener('change', function() {
          if (telefonec.checked) {
            telefone.value = telefonec.value;
          }
        });

      });
    </script>
  </main>

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
</body>

</html>