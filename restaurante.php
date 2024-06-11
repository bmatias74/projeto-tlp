<?php
include("db/conexao.php");

?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KINO</title>

    <link rel="stylesheet" href="CSS/Style.CSS">
    <link rel="stylesheet" href="CSS/configstyle.css">
    <link rel="stylesheet" href="CSS/restaurante.css">

    <link rel="shortcut icon" href="logo.ico" type="image/x-icon">

</head>

<body>
    <?php

    $idrestaurante =  mysqli_real_escape_string($conexao, $_GET["id"]);
    $query = "SELECT * FROM restaurante where id_restaurante = {$idrestaurante}"; // Consulta para buscar as imagens
    $result = mysqli_query($conexao, $query);

    if (mysqli_num_rows($result) > 0) {


        while ($row = mysqli_fetch_assoc($result)) {
            $imageUrl = $row['imagem_p']; // Caminho da imagem
            $nomeRestaurante = $row['nome']; // Nome do restaurante
            $descricao = $row['descricao']; // desecricao do restaurante


        }
    } else {
    }


    ?>
    <?php
    include("itens\header.php")
    ?>
    <input type="hidden" name="pesquisar" id="pesquisaR" value="pesquisa">
    <input type="hidden" name="nome_restaurante_headesr" id="nome-rh" value="<?= $nomeRestaurante ?>">
    <main class="mainR">
        <div class="imagens"></div>
        <article id="mainR">
            <!-- PHP INICIO-->
            <?php

            $idrestaurante =  mysqli_real_escape_string($conexao, $_GET["id"]);
            $query = "SELECT * FROM restaurante where id_restaurante = {$idrestaurante}"; // Consulta para buscar as imagens
            $result = mysqli_query($conexao, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $imageUrl = $row['imagem_p']; // Caminho da imagem
                    $nomeRestaurante = $row['nome']; // Nome do restaurante
                    $descricao = $row['descricao']; // desecricao do restaurante
                    $imagem1 = $row['imagem_s1']; // imagem 1 do restaurante
                    $imagem2 = $row['imagem_s2']; // imagem 2 do restaurante
                    $imagem3 = $row['imagem_s3']; // imagem 3 do restaurante
                    $imagem4 = $row['imagem_s4']; // imagem 4 do restaurante
                    $loc_web = $row['web_loc']; // embebed do google maps

                }
            } else {
                echo "<p>Nenhuma imagem encontrada.</p>";
            }

            mysqli_close($conexao); // Fecha a conexão com o banco de dados
            ?>
            <!-- IMAGEM PRINCIPAL INICIO -->
            <div class="imagem_pd">
                <img class="imagem_p" src="IMG_restaurante/<?= $imageUrl ?>" alt="">
            </div>
            <!-- IMAGEM PRINCIPAL FIM -->

            <!-- PHP FIM-->
            <!-- SLIDER INICIO-->
            <div class="slider">
                <div class="slides">
                    <!-- RADIO INICIO-->
                    <?php
                    $numSlides = 0;
                    for ($i = 1; $i <= 4; $i++) { // o máximo é de 4 imagens
                        if (!empty(${"imagem" . $i})) { // Verifique se a imagem não está vazia
                            $numSlides++;
                    ?>
                            <input type="radio" id="radio<?= $i ?>" name="radio-btn">
                    <?php
                        }
                    }
                    ?>
                    <!-- RADIO FIM-->

                    <!-- IMAGENS INICIO-->
                    <?php
                    for ($i = 1; $i <= $numSlides; $i++) {
                        if (!empty(${"imagem" . $i})) { // Verifique se a imagem não está vazia
                    ?>
                            <div class="slide" id="imagem<?= $i ?>">
                                <img src="IMG_restaurante/<?= ${"imagem" . $i} ?>" alt="">
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <!-- NAVEGAÇÂO AUTOMÁTICA INICIO -->
                    <div class="navega-auto">
                        <?php
                        for ($i = 1; $i <= $numSlides; $i++) {
                            if (!empty(${"imagem" . $i})) { // Verifique se a imagem não está vazia
                        ?>
                                <div class="auto-btn<?= $i ?>"></div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <!-- NAVEGAÇÃO AUTOMÁTICA FIM -->
                </div>
                <!-- NAVEGAÇÃO MANUAL INICIO -->
                <div class="navega-mano">
                    <?php
                    for ($i = 1; $i <= $numSlides; $i++) {
                        if (!empty(${"imagem" . $i})) { // Verifique se a imagem não está vazia
                    ?>
                            <label for="radio<?= $i ?>" class="manual-btn" id="radion<?= $i ?>"></label>
                    <?php
                        }
                    }
                    ?>
                </div>
                <!--  NAVEGAÇÃO MANUAL FIM -->



            </div>
            <!-- SLIDER FIM-->

            <!-- MAPA INICIO-->

            <div class="map">
                <?php
                echo $loc_web;
                ?>
            </div>
            <!-- MAPA FIM-->

        </article>
    </main>
    <!-- footer inicio-->
    <?php
    include("itens/footer.php");
    ?>
    <!-- footer FIM-->
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const root = document.documentElement;
            let contador = 1;
            const slidesContainer = document.querySelector('.slides');
            const radioButtons = document.querySelectorAll('#radio1, #radio2, #radio3, #radio4');
            const navegador = document.querySelectorAll('#radion1, #radion2, #radion3, #radion4');

            radioButtons.forEach((radio, index) => {
                radio.addEventListener('change', () => {
                    if (radio.checked) {
                        navegador.forEach((radion, ind) => {
                            radion.style.backgroundColor = '';
                            if (ind === index) {
                                radion.style.backgroundColor = 'red';
                            }
                        });

                        const marginLeft = -200 * index;
                        slidesContainer.style.marginLeft = `${marginLeft}%`;
                    }
                });
            });

            setInterval(function() {

                document.getElementById('radio' + contador).checked = true;
                radioButtons[contador - 1].dispatchEvent(new Event('change'));
                contador++;
                if (contador > 4) {
                    contador = 1;
                }


            }, 500);

        });
    </script>
    </script>
    <script src="JS/principal.js"></script>
    <script>

    </script>
</body>

</html>