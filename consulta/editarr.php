<?php

$idtchibiye =  mysqli_real_escape_string($conexao, $_GET["idrestaurante"]);
$sql= "SELECT * FROM restaurante WHERE id_restaurante= {$idtchibiye}"; 
$resultado = mysqli_query($conexao,$sql) or die("Erro ao recuperar os dados.". mysqli_error($conexao));
$linha = mysqli_fetch_assoc($resultado);


?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar restaurante</title>
    <link rel="stylesheet" href="./CSS/Login1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="logo.ico" type="image/x-icon">
</head>
<body>
<header>
          <a href="index.php"><img  class="logo" src="logo.png" alt=""></a>
        <h1> Editar</h1>
      </header>
<main>
 <form class="formulario" id = "formulario" action="adm.php?menuop=atualizarr" enctype="multipart/form-data" method="post" >
    <!-- foto principal-->   
  <div class="upload">
    
   
<img src="./IMG_restaurante/<?=$linha["imagem_p"] ?>" alt="" width = 125  id="imagePreview" height = 125 >
        <div class="round">
          <input type="file" name="image" id = "imageInput" accept=".jpg, .jpeg, .png" >
          <i class = "fa fa-camera" style = "color: #fff;"></i>
        </div>
      </div>
 

  <div class="inputg">
                <!-- Id do restaurante--> 
            <div class="input-box">
                <label for="IDRestaurante">ID</label><!--1-->
                <input  type="text" name="id" readonly value="<?=$linha["id_restaurante"] ?>" >
            </div>
               <!-- Nome--> 
             <div>
               <label for="nome">Nome<span class="obrigatorio">*</span></label>
                <input type="text" placeholder="Insira o nome completo" name="Nome" value="<?=$linha["nome"] ?>">
             </div>
               <!-- Email--> 
              <div>
                <label for="email">Email</label>
                <input type="email" placeholder="Insira o email" name="Email" value="<?=$linha["email"] ?>" >
              </div>
           
               <!-- Telefone--> 
                <div>
                      <label for="telefone"> Telefone</label>
                              <input type="telephone" name="telefone" id="telefone" placeholder="Telefone" value="<?=$linha["telefone"] ?>" maxlength="9">
                              <small id="telefone-error" style=" display: none;">O número de telefone deve ter exatamente 9 dígitos.</small>
                </div>
                <!-- Telefone2--> 
                <div>
                  <label for="telefone2">Telefone opcional</label>
                                <input type="telephone" placeholder="Insira o número de telefone" name="telefone2" id="telefone2"  value="<?=$linha["telefone2"] ?> "maxlength="9" >
                                <small id="telefone-error2" style="color: red; display: none;">O número de telefone deve ter exatamente 9 dígitos.</small>
                </div>
              <!-- Descrição--> 
              <div>
                <label for="data">Descrição</label>
                <input type="text" id="descricao" name="descricao"  placeholder="Digite uma descrição acerca do restaurante" >
              </div>
               <!-- Localização--> 
              <div>
                <label for="Localizção web">localização no google maps</label>
                <input type="text" name="localizacao" value="<?=$linha["web_loc"] ?>"
                placeholder="Digite a Localização">
              </div>
               <!-- Morada--> 
               <div>
                <label for="Localizção ">localização </label>
                <input type="text" name="morada"
                placeholder="Digite a Localização"  value="<?=$linha["morada"] ?>">
              </div>
               <!-- Facebook--> 
              <div>
                <label for="facebook">Facebook</label>
                <input type="text" placeholder="Se tiver insira o facebook da empresa" name="facebook"  value="<?=$linha["facebook"] ?>">
              </div>
              <!--instagram --> 
              <div>
                <label for="">Instagram</label>
                <input type="text" placeholder="Se tiver insira o instagram da empresa" name="instagram"  value="<?=$linha["instagram"] ?>">
              </div>
              <!-- Twitter--> 
              <div>
                <label for="Twitter">Twitter</label>
                <input type="text" placeholder="Se tiver insira o twitter da empresa" name="twitter"  value="<?=$linha["twitter"] ?>">
              </div>

        </div>
        <br>
      <div class="muitos_uploads">
          <!-- Image 2--> 
        <div class="upload">
             
             <img src="./IMG_restaurante/<?=$linha["imagem_s1"] ?>" alt="" width = 125 height = 125  id="imagePreview2">
          <div class="round">
            
            <input type="file" name="image2" id = "imageInput2" accept=".jpg, .jpeg, .png"  value="">
            <i class = "fa fa-camera" style = "color: #fff;"></i>
          </div>
        </div>
         <!-- Image 3--> 
        <div class="upload">
             
             <img src="./IMG_restaurante/<?=$linha["imagem_s2"] ?>" alt="" width = 125 height = 125 id="imagePreview3" >
          <div class="round">
      
            <input type="file" name="image3"  id = "imageInput3" accept=".jpg, .jpeg, .png"  >
            <i class = "fa fa-camera" style = "color: #fff;"></i>
          </div>
        </div>
         <!-- Image 4--> 
        <div class="upload">
             
             <img src="./IMG_restaurante/<?=$linha["imagem_s3"] ?>" alt="" width = 125 height = 125 id="imagePreview4" >
          <div class="round">
          
            <input type="file" name="image4" id = "imageInput4" accept=".jpg, .jpeg, .png"  >
            <i class = "fa fa-camera" style = "color: #fff;"></i>
          </div>
        </div>
         <!-- Image 5--> 
        <div class="upload">
             
             <img src="./IMG_restaurante/<?=$linha["imagem_s4"] ?> " alt="" width = 125 height = 125 id="imagePreview5" >
          <div class="round">
           
            <input type="file" name="image5" id = "imageInput5" accept=".jpg, .jpeg, .png"  >
            <i class = "fa fa-camera" style = "color: #fff;"></i>
          </div>
        </div>
      </div>
      <button type="submit" > Inserir</button>
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

</main>
</body>
</html>