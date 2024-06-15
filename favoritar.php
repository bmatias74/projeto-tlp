<?php
include("db/conexao.php");

$dadosJSON = file_get_contents('php://input');
$dados = json_decode($dadosJSON, true);

if (isset($dados['id_usuario']) && isset($dados['id_restaurante'])) {
    $id = $dados['id_usuario'];
    $id_restaurante = $dados['id_restaurante'];
    
    $sqlE = $conexao->prepare("SELECT * FROM favorito WHERE id = ? AND id_restaurante = ?");
    $sqlE->bind_param("ii", $id, $id_restaurante);
    $sqlE->execute();
    $resultado = $sqlE->get_result();
    
    if ($resultado->num_rows > 0) {
        $sqlD = $conexao->prepare("DELETE FROM favorito WHERE id = ? AND id_restaurante = ?");
        $sqlD->bind_param("ii", $id, $id_restaurante);
        $sqlD->execute();
        $sqlD->close();
    } else {
        $sql = $conexao->prepare("INSERT INTO favorito (id, id_restaurante) VALUES (?, ?)");
        $sql->bind_param("ii", $id, $id_restaurante);
        $sql->execute();
        $sql->close();
    }
    
    $sqlE->close();
}

$conexao->close();
?>
