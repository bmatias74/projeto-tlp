<?php
 session_start();
 
 include("../db/conexao.php");
    require('../home/home.php');
require ('../lib/vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



function enviar()
{
    $mail = new PHPMailer(true);
    try
    { 


        // Configurações do servidor SMTP do Mailtrap
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '594e18ae909862';
        $mail->Password = '4cd323ceca790f';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 2525;

        // Define o remetente
        $mail->setFrom('bakongoghost@gmail.com', 'Ipps dos bons');

        // Define o destinatário
        $mail->addAddress($_SESSION["email_destinos"], $_SESSION["nome_destinos"]);

        // Conteúdo da mensagem
        $mail->isHTML(true);
        $mail->Subject = 'Confirmação de Consulta';
        $mail->CharSet = 'UTF-8';
        $mail->Body = "<h1>Olá {$_SESSION["nome_destinos"]},</h1><p>informamos que a sua consulta foi confirmada e está marcada para {$_SESSION["data_destino"]}.</p>";

        // Enviar
        $mail->send();
    }
    catch (Exception $e)
    {
        return false; // Falha no envio
    }
}

function rejeitar()
{
    $mail = new PHPMailer(true);
    try
    {
        // Configurações do servidor SMTP do Gmail
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '594e18ae909862';
        $mail->Password = '4cd323ceca790f';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 2525;

        // Define o remetente
        $mail->setFrom('bakongoghost@gmail.com', 'Ipps dos bons');

        // Define o destinatário
        $mail->addAddress($_SESSION["email_destinos"], $_SESSION["nome_destinos"]);

        // Conteúdo da mensagem
        $mail->isHTML(true);
        $mail->Subject = 'Rejeição de Consulta';
        $mail->CharSet = 'UTF-8';
        $mail->Body = "<h1>Olá {$_SESSION["nome_destinos"]},</h1><p>informamos que a sua marcação de consulta não foi aceita. Por favor, entre em contato conosco para mais informações.</p>";

        // Enviar
        $mail->send();
    }
    catch (Exception $e)
    {
        return false; // Falha no envio
    }
}

// Exemplo de uso:


?>
