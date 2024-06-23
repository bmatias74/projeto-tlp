<?php
include("db/conexao.php");
// pesquisa
if (isset($_GET['action']) && $_GET['action'] == 'reset') {
  // Retorna todos os restaurantes
  $query = $conexao->prepare("SELECT * FROM restaurante");
  $query->execute();
  $resultados = $query->get_result();
  $restaurantesR = $resultados->fetch_all(MYSQLI_ASSOC);
  header('Content-Type: application/json');
  echo json_encode($restaurantesR);
  exit;
}

if (isset($_GET['search'])) {
  $searchterm = $_GET['search'];
  $searchterm = "%$searchterm%";
  $searchquery = $conexao->prepare("SELECT * FROM restaurante WHERE nome LIKE ?");
  $searchquery->bind_param("s", $searchterm);
  $searchquery->execute();
  $resultados = $searchquery->get_result();
  $restaurantesR = $resultados->fetch_all(MYSQLI_ASSOC);
  header('Content-Type: application/json');
  echo json_encode($restaurantesR);
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COKULIMER</title>
  <link rel="stylesheet" href="CSS/Style.CSS">
  <link rel="stylesheet" href="CSS/configstyle.css">
  <link rel="shortcut icon" href="logo.ico" type="image/x-icon">

</head>

<body>
  <?php
  include("itens\header.php")
  ?>   

  <main >
    <h1>Sitios do seu agrado, para encher a barriga</h1>
    <article>

      <?php


      $query = "SELECT * FROM restaurante"; // Consulta para buscar as imagens
      $result = mysqli_query($conexao, $query);

      if (mysqli_num_rows($result) > 0) {
        echo '<div class="imagens">';

        while ($row = mysqli_fetch_assoc($result)) {
          $imageUrl = $row['imagem_p']; // Caminho da imagem
          $nomeRestaurante = $row['nome']; // Nome do restaurante
          $restauranteId = $row['id_restaurante']; // Id do restaurante
          // HTML para cada restaurante
          echo '<div class="co">';
          echo "<a href='restaurante.php?id=$restauranteId'><img src='IMG_restaurante/$imageUrl' alt='Restaurante $nomeRestaurante'></a>";
          echo "<figcaption for='text'> $nomeRestaurante</figcaption>";
          echo '</div>';
        }

        echo '</div>';
        echo '<div id="pagination-container"></div>';
      } else {
        echo "<p>Nenhuma imagem encontrada.</p>";
      }

      mysqli_close($conexao); // Fecha a conexão com o banco de dados
      ?>


    </article>

  </main>
  <?php
  include("itens/footer.php");
  ?>
  <script src="JS/principal.js"></script>
</body>

</html>