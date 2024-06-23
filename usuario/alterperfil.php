<?php
include("../db/conexao.php");

// Sanitize input data
$nome = mysqli_real_escape_string($conexao, $_POST["nome"]);
$email = mysqli_real_escape_string($conexao, $_POST["email"]);
$telefone = mysqli_real_escape_string($conexao, $_POST["telefone"]);
$datadenascimento = mysqli_real_escape_string($conexao, $_POST["datadenascimento"]);
$id = $_POST['id'];
$senha_antiga = $_POST['senha'];
$senha_nova = $_POST['senha2'];

function emailExists($conexao, $email, $currentUserId)
{
    $query = "SELECT 1 FROM usuario WHERE email = ? AND id != ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("si", $email, $currentUserId);
    $stmt->execute();
    $stmt->store_result();
    $exists = $stmt->num_rows > 0;
    $stmt->close();
    return $exists;
}

$response = '';
$resposta = '';

// Validate email and password
$sqrtm = $conexao->prepare("SELECT senha, email FROM usuario WHERE id = ?");
$sqrtm->bind_param("i", $id);
$sqrtm->execute();
$resultS = $sqrtm->get_result();
$row = $resultS->fetch_assoc();
$sqrtm->close();

if (!$row) {
    $response = "Usuário não encontrado.";
} else {
    if ($email !== $row['email']) {
        $response = "O email Antigo não é o correcto.";
    } else {
       
        if (emailExists($conexao, $email, $id)) {
            $response = "Email já registrado. Tente outro email.";
        } else {
            if (!empty($senha_antiga) && !empty($senha_nova) && password_verify($senha_antiga, $row['senha'])) {
                // Hash new password
                $senha_hash = password_hash($senha_nova, PASSWORD_DEFAULT);

                // Update user information and password
                $sql = "UPDATE usuario SET nome = ?, email = ?, telefone = ?, datadenascimento = ?, senha = ? WHERE id = ?";
                $stmt = $conexao->prepare($sql);
                $stmt->bind_param("sssssi", $nome, $email, $telefone, $datadenascimento, $senha_hash, $id);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    $response = "Informações atualizadas com sucesso.";
                } else {
                    $response = "Erro ao atualizar informações: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $response = "Senha antiga incorreta ou novas senhas não coincidem.";
            }

            // Image handling
            if (!empty($_FILES["image"]["name"])) {
                $imageName = $_FILES["image"]["name"];
                $tempName = $_FILES["image"]["tmp_name"];
                $sizeImage = $_FILES["image"]["size"];

                $validImage = ['jpg', 'jpeg', 'png'];
                $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

                if (!in_array($imageExtension, $validImage)) {
                    $resposta = "Extensão de imagem inválida. Use JPG, JPEG ou PNG.";
                } elseif ($sizeImage > 4000000) {
                    $resposta = "Imagem muito grande. Limite é 4MB.";
                } else {
                    $pasta = 'IMG_USUARIO/';
                    $imagemNome = $nome . '.' . $imageExtension;
                    $arquivo = $pasta . basename($imagemNome);

                    if (move_uploaded_file($tempName, $arquivo)) {
                        // Update user profile image
                        $istmt = $conexao->prepare("UPDATE usuario SET imagem_p = ? WHERE id = ?");
                        $istmt->bind_param("si", $imagemNome, $id);
                        $istmt->execute();
                        $istmt->close();
                        $resposta = "Imagem atualizada com sucesso.";
                    } else {
                        $resposta = "Falha ao enviar a imagem.";
                    }
                }
            }
        }
    }
}

$conexao->close();

echo json_encode(['response' => $response, 'resposta' => $resposta]);
