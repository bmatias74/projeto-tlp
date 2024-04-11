<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KINO</title>
    <link rel="stylesheet" href="CSS/Style.CSS">
    <link rel="shortcut icon" href="logo.ico" type="image/x-icon">
    <script src="JS/principal.js"></script>
</head >
<body >
   
      <div class="header">
        <header>
        
            <a href="#"><img  class="logo" src="logo.png" alt=""></a>
        
          <h1> Site</h1>
            <div class="search-box">
            <input class="search-text" type="text" placeholder="Pesquise aqui">
            <a class="search-btn" href="#">
        <img src="IMG/loupe-svgrepo-com.svg" alt="lupa" height="19" width="19">
            </a>
          </div>
          <p class="button"> <a href="cadastramento.html">Cadastre-se</a> </p>
          <p class="button"><a href="login.html">Login</a></p>
        </header>
         <nav>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Fale Conosco</a></li>
          </ul>
            </nav>
      </div>
 <main>
  <h1>arroz</h1>
  <article>
  
  <?php
include "db/conexao.php"; // Inclui o arquivo de conexão

$query = "SELECT nome, imagem_p FROM restaurante"; // Consulta para buscar as imagens
$result = mysqli_query($conexao, $query);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="imagens">';

    while ($row = mysqli_fetch_assoc($result)) {
        $imageUrl = $row['imagem_p']; // Caminho da imagem
        $nomeRestaurante = $row['nome']; // Nome do restaurante

        // HTML para cada restaurante
        echo '<div class="co">';
        echo "<a href=''><img src='IMG_restaurante/$imageUrl' alt='Restaurante $nomeRestaurante'></a>";
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
 <footer>
<p>Site criado por <strong>Tchibiye</strong></p>
 </footer>

</body>
</html>