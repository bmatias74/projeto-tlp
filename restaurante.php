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
    // Buscar dados do restaurante
    $idrestaurante = mysqli_real_escape_string($conexao, $_GET["id"]);
    $query = "SELECT * FROM restaurante WHERE id_restaurante = {$idrestaurante}";
    $result = mysqli_query($conexao, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $imageUrl = $row['imagem_p'];
        $nomeRestaurante = $row['nome'];
        $descricao = $row['descricao'];
        $twitter = $row['twitter'];
        $instagram = $row['instagram'];
        $facebook = $row['facebook'];
        $imagem1 = $row['imagem_s1'];
        $imagem2 = $row['imagem_s2'];
        $imagem3 = $row['imagem_s3'];
        $imagem4 = $row['imagem_s4'];
        $loc_web = $row['web_loc'];
    } else {
        echo "<p>Nenhuma imagem encontrada.</p>";
    }

    include("itens/header.php");
    ?>

    <input type="hidden" name="pesquisar" id="pesquisaR" value="pesquisa">
    <input type="hidden" name="nome_restaurante_header" id="nome-rh" value="<?= htmlspecialchars($nomeRestaurante) ?>">

    <main class="mainR">
        <div class="imagens"></div>
      
            <input type="hidden" name="id_usuario" id="id_usuario" value="<?= htmlspecialchars($_SESSION['id']) ?>">
            <input type="hidden" name="id_restaurante" id="id_restaurante" value="<?= htmlspecialchars($idrestaurante) ?>">

            <section class="sobre">
                <div class="imagem_pd">
                    <img class="imagem_p" src="IMG_restaurante/<?= htmlspecialchars($imageUrl) ?>" alt="<?= htmlspecialchars($nomeRestaurante) ?>">
                </div>
                <div class="sobre-text">
                    <h1> Acerca do nosso restaurante</h1>
                    <p> <?= $descricao ?></p>
                </div>
            </section>
                <article class="contactos">
                    <section class="redes">
                    
                    </section>
                    <section class="contacto">

                    </section>
                </article>
            <div class="slider">
                <div class="slides">
                    <!-- RADIO INICIO -->
                    <?php
                    $numSlides = 0;
                    for ($i = 1; $i <= 4; $i++) {
                        if (!empty(${"imagem" . $i})) {
                            $numSlides++;
                            echo '<input type="radio" id="radio' . $i . '" name="radio-btn">';
                        }
                    }
                    ?>
                    <!-- RADIO FIM -->

                    <!-- IMAGENS INICIO -->
                    <?php
                    for ($i = 1; $i <= $numSlides; $i++) {
                        if (!empty(${"imagem" . $i})) {
                            echo '<div class="slide" id="imagem' . $i . '">
                                    <img src="IMG_restaurante/' . htmlspecialchars(${"imagem" . $i}) . '" alt="Imagem ' . $i . '">
                                  </div>';
                        }
                    }
                    ?>
                    <!-- NAVEGAÇÃO AUTOMÁTICA INICIO -->
                    <div class="navega-auto">
                        <?php
                        for ($i = 1; $i <= $numSlides; $i++) {
                            if (!empty(${"imagem" . $i})) {
                                echo '<div class="auto-btn' . $i . '"></div>';
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
                        if (!empty(${"imagem" . $i})) {
                            echo '<label for="radio' . $i . '" class="manual-btn" id="radion' . $i . '"></label>';
                        }
                    }
                    ?>
                </div>
                <!-- NAVEGAÇÃO MANUAL FIM -->
            </div>

            <div class="map">
                <?= $loc_web ?>
            </div>

            <!-- Favoritar INICIO -->
            <?php
            $id_usuario = $_SESSION['id'];
            $sqlf = "SELECT * FROM favorito WHERE id = '$id_usuario' AND id_restaurante = '$idrestaurante'";
            $resultadoF = mysqli_query($conexao, $sqlf) or die("Erro na consulta: " . mysqli_error($conexao));
            $favoritar = 'nfavoritou';

            if (mysqli_num_rows($resultadoF) > 0) {
                $favoritar = 'favoritou';
            }
            //Número de favoritos
            $sqlnumerof = "SELECT * FROm favorito where id_restaurante = '$idrestaurante'";
            $resultadonumerof = mysqli_query($conexao, $sqlnumerof);
            $numerof = mysqli_num_rows($resultadonumerof);
            ?>
            <div class="favoritos">

                <input type="hidden" name="" id="alertfavorito" value="<?= $favoritar ?>">
                <a id="favoritarbtn">
                    <img src="bx-star.svg" alt="" id="favoritar" value="favorita">
                </a>
                <p id="numeroF"></p>
                <input type="hidden" name="" id="nFavoritos" value="<?= $numerof ?>">
            </div>

            <input type="hidden" name="" id="alertlogado" value="<?= $se_logou ?>">


            <!-- Favoritar FIM -->

    </main>

    <?php include("itens/footer.php"); ?>

    <script>
        const favoritarimg = document.getElementById('favoritar');
        const alertfavoritoInput = document.getElementById('alertfavorito');
        let Nfavorito = document.getElementById('nFavoritos').value;
        const pfavorito = document.getElementById('numeroF');
        let extenxo;
        let numerof;
        numerof = Nfavorito;
        if (numerof > 1000000) {
            numerof = numerof / 1000000;
            extenso = 'Milhão';
            numerof = numerof.toFixed(2);
        } else if (numerof > 1000) {
            numerof = numerof / 1000;
            extenso = 'Mil';
            numerof = numerof.toFixed(3);
        } else {
            extenso = '';
        }
        numerof += ' ' + extenso;

        let alertfavorito = alertfavoritoInput.value;

        if (alertfavorito === 'favoritou') {
            favoritarimg.src = 'bxs-star.svg';
            testnumerof = parseFloat(numerof);
        } else if (alertfavorito === 'nfavoritou') {
            favoritarimg.src = 'bx-star.svg';
            testnumerof = parseFloat(numerof) + 1;
        }

        document.getElementById('favoritarbtn').addEventListener('click', function() {
            if (alertfavorito === 'nfavoritou') {
                alertfavorito = 'favoritou';
                favoritarimg.src = 'bxs-star.svg';
                pfavorito.innerText = parseFloat(numerof) + 1;
                pfavorito.innerText = testnumerof;
                favoritar();
            } else if (alertfavorito === 'favoritou') {
                alertfavorito = 'nfavoritou';
                favoritarimg.src = 'bx-star.svg';
                pfavorito.innerText = parseFloat(numerof) - 1;
                favoritar();
            }
        });


        pfavorito.innerText = numerof;


        function favoritar() {

            const alertlogado = document.getElementById('alertlogado').value;
            if (alertlogado === 'nlogado') {
                alert("Se cadastre");
            }

            var dados = {
                id_restaurante: document.getElementById('id_restaurante').value,
                id_usuario: document.getElementById('id_usuario').value
            };

            fetch('favoritar.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(dados)
                })
                .then(response => response.json())
                .then(dados => {
                    console.log(dados);
                })
                .catch(error => {
                    console.error('ERRO:', error);
                });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
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

                        slidesContainer.style.marginLeft = `-${200 * index}%`;
                    }
                });
                radi.addEventListener('click', () => {
                    let inde = index;
                    contador = inde;
                });
            });

            setInterval(() => {
                document.getElementById('radio' + contador).checked = true;
                radioButtons[contador - 1].dispatchEvent(new Event('change'));
                contador++;
                if (contador > 4) {
                    contador = 1;
                }
            }, 500); // Ajuste do intervalo conforme necessário
        });
    </script>
    <script src="JS/principal.js"></script>
</body>

</html>

<?php mysqli_close($conexao); ?>