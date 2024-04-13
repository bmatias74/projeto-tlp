<?php
session_start();

function verificarSessao() {
    
    if (!isset($_SESSION['emailu'])) {
        header("Location: login.php");
        exit();
    }
}
?>
