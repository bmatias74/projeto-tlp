<?php



$logado = false;
$se_logou = 'nlogado';
if (isset($_SESSION['emailu'])) {
    $email = $_SESSION['emailu'];
    $logado = true;
    $se_logou = 'logado';

    //  user nome
    $stmt = $conexao->prepare("SELECT nome FROM usuario WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($nome);
    $stmt->fetch();
    $stmt->close();
    $_SESSION['nome'] = $nome;

    //  user ID
    $stmti = $conexao->prepare("SELECT id FROM usuario WHERE email=?");
    $stmti->bind_param("s", $email);
    $stmti->execute();
    $stmti->bind_result($id);
    $stmti->fetch();
    $stmti->close();
    $_SESSION['id'] = $id;
}

// Checagem
if (!$logado) {
  echo ' <h1 style =  "color:white">
  Precisas estar logado
  </h1>
  ';
  exit;
}

// paginação
$qtd = 10;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($qtd * $pagina) - $qtd;

// pegar os restaurantes
$stmtg = $conexao->prepare("SELECT * FROM favorito INNER JOIN restaurante ON restaurante.id_restaurante = favorito.id_restaurante WHERE favorito.id = ? LIMIT ?, ?");
$stmtg->bind_param("iii", $id, $inicio, $qtd);
$stmtg->execute();
$resultadog = $stmtg->get_result();
$favorites = [];
while ($row = $resultadog->fetch_assoc()) {
    $favorites[] = $row;
}
$stmtg->close();

// Fetch total number of favorite restaurants for pagination
$sqlt = "SELECT COUNT(*) AS total FROM favorito WHERE id = ?";
$stmtt = $conexao->prepare($sqlt);
$stmtt->bind_param("i", $id);
$stmtt->execute();
$stmtt->bind_result($total_favorites);
$stmtt->fetch();
$stmtt->close();
$totalpg = ceil($total_favorites / $qtd);

$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COKULIMER</title>
  <link rel="stylesheet" href="../CSS/favoritos.css">
  <link rel="stylesheet" href="../CSS/configstyle.css">
  <link rel="shortcut icon" href="logo.ico" type="image/x-icon">
</head>
<body>
  
    <h1>Seus restaurantes favoritos</h1>
  
      <?php if (count($favorites) > 0): ?>
        <div class="imagens">
          <?php foreach ($favorites as $row): ?>
            <div class="co">
              <a href="../restaurante.php?id=<?php echo htmlspecialchars($row['id_restaurante']); ?>">
                <img src="../IMG_restaurante/<?php echo htmlspecialchars($row['imagem_p']); ?>" alt="Restaurante <?php echo htmlspecialchars($row['nome']); ?>">
              </a>
              <figcaption for="text"><?php echo htmlspecialchars($row['nome']); ?></figcaption>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p>Nenhuma imagem encontrada.</p>
      <?php endif; ?>

        <?php if ($pagina > 1): ?>
          <a class="pagination-container" href="?menuop=favoritos&pagina=1">Primeira página</a>
          <a class="pagination-container" href="?menuop=favoritos&pagina=<?php echo $pagina - 1; ?>"><<</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalpg; $i++): ?>
          <?php if ($i >= $pagina - 5 && $i <= $pagina + 5): ?>
            <?php if ($i == $pagina): ?>
              <div class="pagination-container" id="pagination-containerp"><?php echo $i; ?></div>
            <?php else: ?>
              <a class="pagination-container" href="?menuop=favoritos&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php endif; ?>
          <?php endif; ?>
        <?php endfor; ?>

        <?php if ($pagina < $totalpg): ?>
          <a class="pagination-container" href="?menuop=favoritos&pagina=<?php echo $pagina + 1; ?>">>></a>
          <a class="pagination-container" href="?menuop=favoritos&pagina=<?php echo $totalpg; ?>">Última página</a>
        <?php endif; ?>
   
    

</body>
</html>
