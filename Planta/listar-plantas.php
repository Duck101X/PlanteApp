<?php
include_once(__DIR__ . '/../Login/config.php'); // conexão com banco
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: Login/login.php');
    exit();
}

$usuario_id = $_SESSION['id'];
$sql = "SELECT * FROM plantas WHERE usuario_id = $usuario_id";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Listar Plantas - PlanteApp</title>
  <link rel="stylesheet" href="../CSS/listar-plantas.css">
  <link rel="icon" type="image/png" href="../img/icon.png">
</head>
<body>
  <header>
    <div class="logo">
      <img src="../img/folha.png" alt="Logo" />
      <a href="../Login/home.php">PlanteApp</a>
    </div>
    <nav>
      <a href="../Login/home.php">Home</a>
      <a href="../Planta/cadastrar-planta.php">Cadastrar Planta</a>
      <a href="../Login/sair.php">Sair</a>
    </nav>
  </header>

  <main>
    <h1>Plantas Cadastradas</h1>
    <div class="plantas-container">
      
      <?php if ($result->num_rows === 0): {
       echo '<p style="color: #224523; font-size: 20px; margin-top: 50px;">Nenhuma planta cadastrada ainda. :(</p>';

       echo  '<a class="cadastrar-plantas" href="../Planta/cadastrar-planta.php">Cadastrar Planta</a>';
      } endif; ?>
      <?php
      while ($row = $result->fetch_assoc()): ?>
      
   
      
      <div class="planta-card">
 
          <div class="planta-actions">
              <tag title="Editar"><a class="planta-actions1" href="editar-planta.php?idplantas=<?= $row['idplantas'] ?>"> <img src="../img/editar.png" alt=""></a> </tag>
              <tag title="Excluir"><a class="planta-actions2" href="excluir-planta.php?idplantas=<?= $row['idplantas'] ?>" onclick="return confirm('Tem certeza que deseja excluir esta planta?');"> <img src="../img/excluir.png" alt=""></a> </tag>
          </div>
          <img src="uploads/<?php echo $row['foto']; ?>" alt="Foto da Planta">
          <h2><?php echo htmlspecialchars($row['nome']); ?></h2>
          <p><strong>Tipo:</strong> <?php echo htmlspecialchars($row['tipo']); ?></p>
          <p><strong>Descrição:</strong> <?php echo htmlspecialchars($row['descricao']); ?></p>
          <p><strong>Opção:</strong> <?php echo htmlspecialchars($row['opcao']); ?></p>
          <p><strong>Preço:</strong> R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></p>
        </div>
      <?php endwhile; ?>

    </div>
  </main>
</body>
</html>
