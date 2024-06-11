<?php
include "db/conexao.php";


// Função para processar o upload da imagem
function processImageUpload($conexao, $imageField, $nome)
{
    if (isset($_FILES[$imageField]["name"])) {
        $imageName = $_FILES[$imageField]["name"];
        $imageSize = $_FILES[$imageField]["size"];
        $tmpName = $_FILES[$imageField]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $imageName);
        $imageExtension = strtolower(end($imageExtension));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Extensão de imagem inválida.'); window.location.href = '../projeto-tlp/Inserir restaurante.php';</script>";
            return false;
        } elseif ($imageSize > 40000000) {
            echo "<script>alert('O tamanho da imagem é muito grande.'); window.location.href = '../projeto-tlp/Inserir restaurante.php';</script>";
            return false;
        } else {
            $newImageName = $nome . "-" . date("Y.m.d") . "-" . date("h.i.sa") . "-" . $imageField . '.' . $imageExtension;
            move_uploaded_file($tmpName, 'IMG_restaurante/' . $newImageName);
            return $newImageName;
        }
    }
    return false;
}

$nome = mysqli_real_escape_string($conexao, $_POST["Nome"]);
$email = mysqli_real_escape_string($conexao, $_POST["Email"]);
$telefone = mysqli_real_escape_String($conexao, $_POST["telefone"]);
$telefone2 = mysqli_real_escape_String($conexao, $_POST["telefone2"]);
$descricao = mysqli_real_escape_String($conexao, $_POST["descricao"]);
$localizacao = mysqli_real_escape_String($conexao, $_POST["morada"]);
$morada = mysqli_real_escape_String($conexao, $_POST["localizacao"]);
$facebook = mysqli_real_escape_String($conexao, $_POST["facebook"]);
$twitter = mysqli_real_escape_String($conexao, $_POST["twitter"]);
$instagram = mysqli_real_escape_String($conexao, $_POST["instagram"]);

// Primeiro, insira o registro básico do restaurante
$query = "INSERT INTO restaurante (nome, email,telefone,telefone2,descricao,web_loc,facebook,twitter,instagram,morada) VALUES ('$nome', '$email','$telefone','$telefone2','$descricao','$localizacao','$facebook','$twitter','$instagram','$morada')";
mysqli_query($conexao, $query);

// Recupera o ID do último restaurante inserido
$lastId = mysqli_insert_id($conexao);

// Chama a função para cada imagem, atualizando o registro do restaurante com os nomes das imagens
$imageFields = ['image' => 'imagem_p', 'image2' => 'imagem_s1', 'image3' => 'imagem_s2', 'image4' => 'imagem_s3', 'image5' => 'imagem_s4'];

foreach ($imageFields as $formField => $dbField) {
    $imageName = processImageUpload($conexao, $formField, $nome);
    if ($imageName) {
        $updateQuery = "UPDATE restaurante SET $dbField = '$imageName' WHERE id = $lastId";
        mysqli_query($conexao, $updateQuery);
    }
}

echo "<script>window.location.href = '../projeto-tlp/Inserir restaurante.php';</script>";
