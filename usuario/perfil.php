<?php



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

//consulta geral
$stmtg = $conexao->prepare("SELECT * FROM usuario where id=?");
$stmtg->bind_param("i", $id);
$stmtg->execute();
$resultadog = $stmtg->get_result();
$linha = $resultadog->fetch_assoc();
$stmtg->close();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração</title>
    <link rel="stylesheet" href="../CSS/configuser.css">
    <link rel="stylesheet" href="../CSS/perfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
</head>
<body>
<?php
// Check if user is logged in
if (!$logado) {
    echo '<h1 class="logado" style="color:white">Precisas estar logado</h1>';
    exit;
}
?>
<form action="alterperfil.php" id="formulario" enctype="multipart/form-data" method="POST">
    <!-- Foto principal -->
    <div class="upload">
        <div class="perfil">
            <img src="IMG_USUARIO/<?= $linha["imagem_p"] ?>" width="125" height="125" title="<?= $linha["imagem_p"] ?>" id="imagePreview">
            <div class="round">
                <input type="file" name="image" id="imageInput" accept=".jpg, .jpeg, .png" readonly>
                <i class="fa fa-camera" style="color: #fff;"></i>
            </div>
        </div>
    </div>

    <div class="inputg">
        <input type="hidden" name="id" value="<?= $id ?>">
        
        <!-- Nome -->
        <div class="itable">
            <label for="nome">Nome</label>
            <input type="text" name="nome" placeholder="Nome" value="<?= $linha["nome"] ?>" readonly>
        </div>
        
        <!-- E-mail -->
        <div class="itable">
            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Email" value="<?= $linha["email"] ?>" readonly>
        </div>
        
        <!-- Telefone -->
        <div class="itable">
            <label for="telefone">Telefone</label>
            <input type="tel" name="telefone" id="telefone" placeholder="Telefone" maxlength="9" value="<?= $linha["telefone"] ?>" readonly>
            <small id="telefone-error" style="display: none;">O número de telefone deve ter exatamente 9 dígitos.</small>
        </div>
        
        <!-- Data de nascimento -->
        <div class="itable">
            <label for="datadenascimento">Data de nascimento</label>
            <input type="date" id="datadenascimento" name="datadenascimento" value="<?= $linha["datadenascimento"] ?>" readonly>
        </div>
        
        <!-- Antiga senha -->
        <div class="itable" >
            <label for="senha">Antiga senha <span class="obrigatorio">*</span></label>
            <input type="password" name="senha" placeholder="Antiga senha"  id="senhaA">
        </div>

        <!-- Nova senha -->
        <div class="itable">
            <label for="senha2">Nova senha</label>
            <input type="password" name="senha2" placeholder="Nova senha" readonly>
        </div>
    </div>

    <button type="submit" onclick="salvar(event)" style="display: none;" id="submeter">Inserir</button>
</form>

<script>
  //READS only
  document.addEventListener("DOMContentLoaded", function() { 
  const  senha = document.getElementById('senhaA');
    const  submeter = document.getElementById('submeter')
      senha.addEventListener('input', () => {
        
        submeter.style.display = 'block';
  
    });
  var  inputs = document.querySelectorAll('input[readonly]');
    inputs.forEach(input => {
      input.addEventListener('click', (event) => {
        if (senha.value.trim() != '') {
          input.removeAttribute('readonly');
        } else {
          alert("Tens que inserir uma senha, antes de fazeres qualquer alteração");
          input.setAttribute('readonly', true);
          event.preventDefault();
        }
      
      });
    
    });
  });
  //submeter
function salvar(event) {
    event.preventDefault();
    const formData = new FormData(document.getElementById('formulario'));

    fetch('alterperfil.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        alert(data.response);
        if (data.resposta) {
            alert(data.resposta);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
//atualizar imahem
document.getElementById('imageInput').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('imagePreview').src = event.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>
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
