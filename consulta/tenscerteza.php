<header>
    <h2>Excluir</h2>
</header>
<?php 
$ID_restaurante =  mysqli_real_escape_string($conexao, $_GET["idrestaurante"]);


        ?>
            <!-- Adicionando um modal de confirmação -->
            <script>
                var confirmar = confirm("Tem certeza que deseja deletar este restaurante( De ID <?= $ID_restaurante?>)?");
                if(confirmar) {
                    // Se o usuário confirmar, redirecione para a página que irá processar a deleção
                    window.location.href = "adm.php?menuop=excluir&idrestaurante=<?php echo $ID_restaurante; ?>";
                 }
                else {
                    // Se o usuário cancelar, redirecione de volta para a página inicial
                    window.location.href = "adm.php?menuop=home";
                }
            </script>
        <?php
            // Saia do script PHP após exibir o modal e o formulário de deleção
            exit;

?>