<?php
include "./db/conexao.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

function processImageUpload($conexao, $imageField, $nome) {
    if (isset($_FILES[$imageField]["name"])) {
        $imageName = $_FILES[$imageField]["name"];
        $imageSize = $_FILES[$imageField]["size"];
        $tmpName = $_FILES[$imageField]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $imageName);
        $imageExtension = strtolower(end($imageExtension));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Extensão de imagem inválida.'); window.location.href = '../adm.php';</script>";
            return false;
        } elseif ($imageSize > 1200000) {
            echo "<script>alert('O tamanho da imagem é muito grande.'); window.location.href = '../adm.php';</script>";
            return false;
        } else {
            $newImageName = $nome . "-" . date("Y.m.d") . "-" . date("h.i.sa") . "-" . $imageField . '.' . $imageExtension;
            if (move_uploaded_file($tmpName, '../IMG_adm/' . $newImageName)) {
                return $newImageName;
            } else {
                echo "<script>alert('Erro ao salvar o arquivo.'); window.location.href = '../adm.php';</script>";
                return false;
            }
        }
    }
    return false;
}

$id = $_POST["id"];
$name = $_POST["nome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$password = password_hash($_POST["senha"], PASSWORD_DEFAULT);
$imageFields = ['image' => 'imagem_p'];

foreach ($imageFields as $formField => $dbField) {
    $imageName = processImageUpload($conexao, $formField, $name);
    if ($imageName) {
        $stmt = $conexao->prepare("UPDATE adm SET $dbField = ?, email = ?, nome = ?, telefone = ?, senha = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("ssssi", $imageName, $email, $name, $telefone, $password, $id);
            if ($stmt->execute()) {
                if (!headers_sent()) {
                    header("Location: ../index.php");
                    exit();
                }
            } else {
                echo "Error updating record: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Prepare failed: " . $conexao->error;
        }
    }
}

if (!headers_sent()) {
    header("Location: ../adm.php");
    exit();
} else {
    echo "Não foi possível redirecionar automaticamente. <a href='../adm.php'>Clique aqui</a> para voltar.";
}
?>
