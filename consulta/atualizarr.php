<?php
include "db/conexao.php";

function processImageUpload($conexao, $imageField, $nome) {
    if (isset($_FILES[$imageField]["name"])) {
        $imageName = $_FILES[$imageField]["name"];
        $imageSize = $_FILES[$imageField]["size"];
        $tmpName = $_FILES[$imageField]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Invalid image extension.'); window.location.href = '../projeto-tlp/Inserir restaurante.php';</script>";
            return false;
        } elseif ($imageSize > 1200000) {
            echo "<script>alert('Image size too large.'); window.location.href = '../projeto-tlp/Inserir restaurante.php';</script>";
            return false;
        } else {
            $newImageName = $nome . "-" . date("Y.m.d-H.i.s") . "-" . $imageField . '.' . $imageExtension;
            move_uploaded_file($tmpName, 'IMG_restaurante/' . $newImageName);
            return $newImageName;
        }
    }
    return false;
}

$nome = mysqli_real_escape_string($conexao, $_POST["Nome"]);
$email = mysqli_real_escape_string($conexao, $_POST["Email"]);
$telefone = mysqli_real_escape_string($conexao, $_POST["telefone"]);
$telefone2 = mysqli_real_escape_string($conexao, $_POST["telefone2"]);
$descricao = mysqli_real_escape_string($conexao, $_POST["descricao"]);
$localizacao = mysqli_real_escape_string($conexao, $_POST["morada"]);
$morada = mysqli_real_escape_string($conexao, $_POST["localizacao"]);
$facebook = mysqli_real_escape_string($conexao, $_POST["facebook"]);
$twitter = mysqli_real_escape_string($conexao, $_POST["twitter"]);
$instagram = mysqli_real_escape_string($conexao, $_POST["instagram"]);
$id = $_POST["id"]; // This should be securely handled and validated

$stmt = $conexao->prepare("UPDATE restaurante SET nome = ?, telefone = ?, telefone2 = ?, email = ?, descricao = ?, web_loc= ?, morada = ?, facebook = ?, twitter = ?, instagram = ? WHERE id = ?");
$stmt->bind_param("ssssssssssi", $nome, $telefone, $telefone2, $email, $descricao, $localizacao, $morada, $facebook, $twitter, $instagram, $id);
$stmt->execute();

$imageFields = ['image' => 'imagem_p', 'image2' => 'imagem_s1', 'image3' => 'imagem_s2', 'image4' => 'imagem_s3', 'image5' => 'imagem_s4'];

foreach ($imageFields as $formField => $dbField) {
    $imageName = processImageUpload($conexao, $formField, $nome);
    if ($imageName) {
        $updateQuery = $conexao->prepare("UPDATE restaurante SET $dbField = ? WHERE id = ?");
        $updateQuery->bind_param("si", $imageName, $id);
        $updateQuery->execute();
    }
}

header("Location: ADM.php?menuop=consulta");
?>
