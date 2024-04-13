

<meta http-equiv="refresh" content="200">
<link rel="stylesheet" href=".\CSS\painel-consulta.css">
<header>
    <h3>Consultas confirmadas</h3>
    <hr>
</header>
<script>
    function limparPesquisa() {
        window.location.href = 'ADM.php?menuop=consulta';
    }
</script>

<div>
    <form action="adm.php?menuop=consulta" method="post">
        <input type="text" name="txt_consulta" placeholder="Insira Nome/ID_consulta" >
        <input type="submit" value="pesquisar">
        <?php
         $txt_pesquisa = isset($_POST["txt_consulta"]) ? $_POST["txt_consulta"] : "";
         ?>
        <?php if (!empty($txt_pesquisa)): ?>
            <button class="button" type="button" onclick="limparPesquisa()">Limpar Pesquisa</button>
        <?php endif; ?>
    </form>
    <?php
    if (!empty($txt_pesquisa)) {
        $sqlt = "SELECT ID_Paciente FROM tbpaciente WHERE (ID_Paciente = '{$txt_pesquisa}' OR Nome LIKE '%{$txt_pesquisa}%')";
        $qrt = mysqli_query($conexao, $sqlt) or die("Erro ao mudar de pagina" . mysqli_error($conexao));
        $numt = mysqli_num_rows($qrt);
        echo "Total de registos: $numt <br> ";
    }
    ?>
</div>
<table border="1">
    <thead>
        <tr>
            <th><a class="ordem" href="?menuop=consulta&organiza=ID_Paciente">ID_Paciente</a></th>
            <th><a class="ordem" href="?menuop=consulta&organiza=Nome">Nome</a></th>
            <th>Sexo</th>
            <th>Telefone</th>
            <th>Tipo de Consulta</th>
            <th>Email</th>
            <th>Asseguradora</th>
            <th>Codigo de consulta</th>
            <th>Data da Consulta</th>
            <th>Cod_ADM</th>
            <td>Cod_medico</td>
            <td>Nome_medico</td>
            <th>Editar</a></th>
            <th>Excluir</th>
        </tr>
    </thead>
    <tbody>  
      
    <?php
// Inicia a sessão ou continua a sessão já iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Se o valor 'muntchiya' foi enviado pelo formulário e é numérico, atualiza o valor na sessão
if (isset($_POST['muntchiya']) && is_numeric($_POST['muntchiya'])) {
    $_SESSION['muntchiya'] = intval($_POST['muntchiya']);
}

// Captura o critério de ordenação a partir da URL, com um valor padrão
$ordenarPor = isset($_GET['organiza']) ? $_GET['organiza'] : 'ID_paciente';

// Lista de colunas permitidas para ordenação
$colunasPermitidas = ['ID_Paciente', 'Nome'];

// Verifica se o valor de ordenarPor está na lista de colunas permitidas
if (!in_array($ordenarPor, $colunasPermitidas)) {
    $ordenarPor = 'ID_Paciente'; // Valor padrão caso não seja uma coluna permitida
}

$qtd = isset($_SESSION['muntchiya']) ? $_SESSION['muntchiya'] : 10;
$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
$inicio = ($qtd * $pagina) - $qtd;


$sql = "SELECT tbpaciente.*, tbmedico.nome_medico FROM tbpaciente 
        INNER JOIN tbmedico ON tbpaciente.id_medico = tbmedico.id_medico
        WHERE (ID_Paciente = '{$txt_pesquisa}' OR Nome LIKE '%{$txt_pesquisa}%')
        ORDER BY $ordenarPor ASC
        LIMIT $inicio, $qtd";


$resultado = mysqli_query($conexao, $sql) or die("Erro na consulta: " . mysqli_error($conexao));

// Obtém a data atual no formato 'Y-m-d' para comparação
$hoje = date('Y-m-d');

// Loop para exibir as consultas
while ($linha = mysqli_fetch_assoc($resultado)) {
    // Verifica se a data da consulta é anterior à data atual
    $data_consulta = date('Y-m-d', strtotime($linha["data_da_consulta"]));
    $row_style = ($data_consulta < $hoje) ? 'style="background-color: brown;"' : '';

    echo "<tr $row_style>";
    echo "<td>{$linha["ID_Paciente"]}</td>";
    echo "<td>{$linha["Nome"]}</td>";
    echo "<td>{$linha["Sexo"]}</td>";
    echo "<td>{$linha["telefone"]}</td>";
    echo "<td>{$linha["Tipo_consulta"]}</td>";
    echo "<td>{$linha["email"]}</td>";
    echo "<td>{$linha["asseguradora"]}</td>";
    echo "<td>{$linha["codigo_de_consulta"]}</td>";
    echo "<td>{$linha["data_da_consulta"]}</td>";
    echo "<td>{$linha["ID_adm"]}</td>";
    echo "<td>{$linha["id_medico"]}</td>";
    echo "<td>{$linha["nome_medico"]}</td>";
    echo "<td><a href=\"adm.php?menuop=editar&idpaciente={$linha["ID_Paciente"]}\" style=\"display:flex; justify-content:center;\"><img src=\"./Imagens/icons/edit.png\" alt=\"\" style=\"width: 20px;\"></a></td>";
    echo "<td><a href=\"adm.php?menuop=tenscerteza&idpaciente={$linha["ID_Paciente"]}\" style=\"display:flex; justify-content:center;\"><img src=\"./Imagens/icons/delete.png\" alt=\"\" style=\"width: 20px;\"></a></td>";

    echo "</tr>";

    
    
}?>

</tbody>
</table>
<?php

$sqlt = "SELECT ID_Paciente FROM tbpaciente";
$qrt = mysqli_query($conexao,$sqlt) or die ("Erro ao mudar de pagina". mysqli_error($conexao));
$numt = mysqli_num_rows($qrt);
$totalpg = ceil($numt/$qtd);
echo("Total paginas: $totalpg  <br>");
echo"<a class= \"pagination-container\" href =\"?menuop=consulta&pagina=1 \"> Primeira pagina  </a> ";
if ($pagina>6){
    ?>
    <a class= "pagination-container" href="?menuop=consulta&pagina=<?php echo $pagina-1?>"> << </a>
    <?php
}
if (isset($_POST["txt_pagina"])) {
    $pagina = (int)$_POST["txt_pagina"]; 

    
    if ($pagina >= 1 && $pagina <= $totalpg) {
        for ($i=1; $i <= $totalpg; $i++){
            if ($i>=($pagina-5) && $i<=($pagina+5)) {
                if ($i==$pagina) {
                    echo "<div class= \"pagination-container\" id= \"pagination-containerp\">$i</div>";
                } else {
                   echo  "  <a  class= \"pagination-container\" href=\"?menuop=consulta&pagina=$i \"> $i   </a>";
                }
            }
            
        }
        if ($pagina< ($totalpg-5)){
            ?>
            <a class= "pagination-container" href="?menuop=consulta&pagina=<?php echo $pagina+1?>"> >></a>
            <?php
        }
                
       
    } else {
        echo "<p>Número da página inválido. Por favor, escolha um número entre 1 e $totalpg.</p>";
    }
}
else{
    if ($pagina >= 1 && $pagina <= $totalpg) {
        for ($i=1; $i <= $totalpg; $i++){
            if ($i>=($pagina-5) && $i<=($pagina+5)) {
                if ($i==$pagina) {
                    echo "<div class= \"pagination-container\" id= \"pagination-containerp\">$i</div>";
                } else {
                   echo  "  <a  class= \"pagination-container\" href=\"?menuop=consulta&pagina=$i \"> $i   </a>";
                }
            }
            
        }
        if ($pagina< ($totalpg-5)){
            ?>
            <a class= "pagination-container" href="?menuop=consulta&pagina=<?php echo $pagina+1?>"> >></a>
            <?php
        }
                
}
}

echo"<a class= \"pagination-container\" href =\"?menuop=consulta&pagina=$totalpg \"> Última pagina  </a>";



?>
<br>
<br>
<div>
    <form action="" method="post">
        <input type="text" name="txt_pagina" placeholder="Insira a pagina" >
        <input type="submit" value="pesquisar">
    </form>
</div>
</body>
</html>