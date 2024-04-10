<?php
session_start();

function verificarSessao() {
    
    if (!isset($_SESSION['email'])) {
        header("Location: admlogin.php");
        exit();
    }
}
?>
