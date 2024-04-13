<header>
    <h2>Excluir</h2>
</header>
<?php 
$ID_usuario=  mysqli_real_escape_string($conexao, $_GET["idusuario"]);


        ?>
            <!-- Adicionando um modal de confirmação -->
            <script>
                var confirmar = confirm("Tem certeza que deseja deletar este usuario?");
                if(confirmar) {
                    // Se o usuário confirmar, redirecione para a página que irá processar a deleção
                    window.location.href = "ADM.php?menuop=excluirp&idusuario=<?php echo $ID_usuario; ?>";
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