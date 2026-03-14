<?php
$nome = $tipo = $descricao = $opcao = $preco = $foto = $troca = "";

if (!empty($_GET['idplantas'])) {
  include_once(__DIR__ . '/../Login/config.php');
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

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../img/icon.png">
  <link rel="stylesheet" href="../CSS/cadastrar-planta.css">
  <title>Editar Planta - PlanteApp</title>
</head>

<body>
  <header>
    <div class="logo">
      <img src="../img/folha.png" alt="Logo" />
      <a href="../Login/home.php">PlanteApp</a>
    </div>
    <nav>
      <a href="../Login/home.php">Home</a>
      <a href="listar-plantas.php">Minhas-Planta</a>
      <a href="../Login/sair.php">Sair</a>
    </nav>
  </header>
  <main>
    <h1>Editar Planta</h1>
    <form action="saveEdit.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="idplantas" value="<?php echo $idplantas; ?>">
      <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" placeholder="Nome da Planta" required>
      <input type="text" id="tipo" name="tipo" value="<?php echo htmlspecialchars($tipo); ?>" placeholder="Tipo de Planta" required>
      <input type="file" id="foto" name="foto" accept="image/*">
      <?php if ($foto): ?>
        <img id="preview" src="uploads/<?php echo htmlspecialchars($foto); ?>" alt="Prévia da imagem" style="max-width:100%; margin-top:10px;">
      <?php else: ?>
        <img id="preview" src="#" alt="Prévia da imagem" style="display:none; max-width:100%; margin-top:10px;">
      <?php endif; ?>
      <input type="hidden" name="foto_atual" value="<?= $dados['foto'] ?>">
      <input type="tel " id="telefone" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>" placeholder="Telefone para contato" required>
      <textarea id="descricao" name="descricao" placeholder="Descrição" required><?php echo htmlspecialchars($descricao); ?></textarea>
      <label for="preco">Preço:</label>

      <select id="opcao" name="opcao" required>
        <option value="">Selecione</option>
        <option value="doar" <?php if ($opcao == 'doar') echo 'selected'; ?>>Doar</option>
        <option value="trocar" <?php if ($opcao == 'trocar') echo 'selected'; ?>>Trocar</option>
        <option value="vender" <?php if ($opcao == 'vender') echo 'selected'; ?>>Vender</option>
      </select>

      <div id="dinheiro-container" style="<?php if ($opcao != 'vender') echo 'display:none;'; ?>">
        <label for="preco">Preço:</label>
        <input type="text" id="preco" name="preco" value="<?php echo htmlspecialchars($preco); ?>">
      </div>

      <div id="troca-container" style="<?php if ($opcao != 'trocar') echo 'display:none;'; ?>">
        <label for="troca">Item para Troca:</label>
        <textarea id="troca" name="troca" placeholder="Item para Troca"><?php echo htmlspecialchars($troca); ?></textarea>
      </div>

      <div id="doacao-container" style="<?php if ($opcao != 'doar') echo 'display:none;'; ?>">
        <span>Doação não envolve valor monetário, contate pelo número contato.</span>
      </div>

      <button type="submit" name="salvar" id="salvar">Salvar</button>
    </form>
    <script>
      
        // Função para atualizar a visibilidade dos contêineres
 document.addEventListener('DOMContentLoaded', function() {
        const opcaoSelect = document.getElementById('opcao');
        const precoInput = document.getElementById('preco');
        const trocaTextarea = document.getElementById('troca');
        const dinheiroContainer = document.getElementById('dinheiro-container');
        const trocaContainer = document.getElementById('troca-container');
        const doacaoContainer = document.getElementById('doacao-container');

        // Função para atualizar a visibilidade e o 'required' dos contêineres
        function updateVisibility() {
            const selectedOption = opcaoSelect.value;
            
            // Oculta todos os contêineres e remove o 'required'
            dinheiroContainer.style.display = 'none';
            trocaContainer.style.display = 'none';
            doacaoContainer.style.display = 'none';
            
            // Remove o `required` de ambos os campos no início da função
            precoInput.removeAttribute('required');
            trocaTextarea.removeAttribute('required');

            if (selectedOption === 'vender') {
                dinheiroContainer.style.display = 'block';
                precoInput.setAttribute('required', 'required'); // Torna o preço obrigatório
            } else if (selectedOption === 'trocar') {
                trocaContainer.style.display = 'block';
                trocaTextarea.setAttribute('required', 'required'); // Torna a troca obrigatória
            } else if (selectedOption === 'doar') {
                doacaoContainer.style.display = 'block';
            }
        }

        // Adiciona o evento de 'change'
        opcaoSelect.addEventListener('change', updateVisibility);

        // Chama a função ao carregar a página para exibir o estado inicial
        // Isso é crucial para que a validação funcione corretamente ao abrir a página
        updateVisibility();
        
        // ... (o restante do seu código JavaScript, como o da foto e do telefone, continua aqui)
        
    });
      document.getElementById('foto').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
          const preview = document.getElementById('preview');
          preview.src = URL.createObjectURL(file);
          preview.style.display = 'block';
        }
      });
      const telInput = document.getElementById('telefone');

      telInput.addEventListener('input', function(e) {
        let valor = e.target.value.replace(/\D/g, "");

        if (valor.length > 11) valor = valor.slice(0, 11);

        if (valor.length > 6) {
          valor = valor.replace(/^(\d{2})(\d{5})(\d{0,4})/, "($1) $2-$3");
        } else if (valor.length > 2) {
          valor = valor.replace(/^(\d{2})(\d{0,4})/, "($1) $2");
        } else {
          valor = valor.replace(/^(\d*)/, "($1");
        }

        e.target.value = valor;
      });

      document.getElementById('preco').addEventListener('input', function(e) {
        let valor = e.target.value.replace(/\D/g, "");
        valor = (valor / 100).toFixed(2); // sempre duas casas decimais
        valor = valor.replace(".", ","); // troca ponto por vírgula
        e.target.value = "R$ " + valor;
      });
    </script>
  </main>
</body>

</html>