<?php
$nome = $tipo = $telefone = $descricao = $opcao = $preco = $foto = "";

if (!empty($_GET['idplantas'])) {
    include_once(__DIR__ . '/Login/config.php');
    $idplantas = $_GET['idplantas'];
    $sqlSelect = "SELECT * FROM plantas WHERE idplantas = $idplantas";
    $result = $conexao->query($sqlSelect);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome = $row['nome'];
        $tipo = $row['tipo'];
        $telefone = $row['telefone'];
        $descricao = $row['descricao'];
        $opcao = $row['opcao'];
        $preco = $row['preco'];
        $foto = $row['foto'];
        $troca = $row['troca'];
    } else {
        echo "Planta não encontrada.";
        exit();
    }
}
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/icon.png">
    <link rel="stylesheet" href="CSS/negociar.css">

    <title>Negociar Planta - PlanteApp</title>
</head>
<body>
  <header>
    <div class="logo">
      <img src="img/folha.png" alt="Logo" />
      <a href="Login/home.php">PlanteApp</a>
    </div>
    <nav>
      <a href="index.php">Home</a>
      <a href="Login/cadastro.php">Cadastrar-se</a>
      <a href="Login/login.php">Entrar</a>
    </nav>
  </header>
  <main>
    <h1>Negociar Planta</h1>
    
    <div class="planta-info">
        <p><strong>Nome da Planta:</strong> <?php echo htmlspecialchars($nome); ?></p>
        <p><strong>Tipo de Planta:</strong> <?php echo htmlspecialchars($tipo); ?></p>
        <p><strong>Telefone para contato:</strong> <?php echo htmlspecialchars($telefone); ?></p>
        <p><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($descricao)); ?></p>
        <p><strong>Opção:</strong> <?php echo htmlspecialchars($opcao); ?></p>
        <p><strong>Preço/Troca:</strong> 
        <?php 
        if ($opcao == 'vender') {
            echo 'R$ ' . htmlspecialchars($preco);
        } elseif ($opcao == 'trocar') {
            echo htmlspecialchars($troca);
        } else { // Se for 'doar' ou qualquer outra coisa
            echo 'doação não envolve valor monetário';
        }
        ?>
        </p>  
        <?php if (!empty($foto)): ?>
            <p><strong>Foto da Planta:</strong></p>
            <img src="Planta/uploads/<?php echo htmlspecialchars($foto); ?>" alt="Foto da planta">
        <?php else: ?>
            <p>Não há foto disponível para esta planta.</p>
        <?php endif; ?>
    </div>
    
    <a href="index.php" class="botao">Voltar</a>
  </main>
</body>
</html>