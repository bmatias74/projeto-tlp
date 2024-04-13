<header>
    <h2>Excluir</h2>
</header>
<?php 
$ID_consulta =  mysqli_real_escape_string($conexao, $_GET["idpaciente"]);


        ?>
            <!-- Adicionando um modal de confirmação -->
            <script>
                var confirmar = confirm("Tem certeza que deseja deletar esta consulta?");
                if(confirmar) {
                    // Se o usuário confirmar, redirecione para a página que irá processar a deleção
                    window.location.href = "ADM.php?menuop=excluir&idpaciente=<?php echo $ID_consulta; ?>";
                 }
                else {
                    // Se o usuário cancelar, redirecione de volta para a página inicial
                    window.location.href = "../ADM.php?menuop=home";
                }
            </script>
        <?php
            // Saia do script PHP após exibir o modal e o formulário de deleção
            exit;

?>