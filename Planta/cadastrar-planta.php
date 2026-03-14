<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="../image/png" href="img/icon.png">
  <link rel="stylesheet" href="../CSS/cadastrar-planta.css">
  <link rel="icon" type="image/png" href="../img/icon.png">
  <title>Cadastar-Planta - PlantApp</title>
</head>

<body>
  <header>
    <div class="logo">
      <img src="../img/folha.png" alt="Logo" />
      <a href="../Login/home.php">PlanteApp</a>
    </div>
    <nav>
      <a href="../Login/home.php">Home</a>
      <a href="listar-plantas.php">Minhas-Plantas</a>
      <a href="../Login/sair.php">Sair</a>
    </nav>
  </header>
  <main>
    <img class="plantamini" src="../img/plantamini.png" alt="Plantamini">
    <h1>Cadastrar Planta</h1>
    <form action="../Planta/processa-planta.php" method="post" enctype="multipart/form-data">
      <input type="text" id="nome" name="nome" placeholder="Nome da Planta" required>
      <input type="text" id="tipo" name="tipo" placeholder="Tipo de Planta" required>
      <input type="file" id="foto" name="foto" accept="image/*" required>
      <input type="tel" id="telefone" name="telefone" placeholder="Telefone para contato" required>
      <img id="preview" src="#" alt="Prévia da imagem" style="display:none; max-width:100%; margin-top:10px;">
      <textarea id="descricao" name="descricao" placeholder="Descrição" required></textarea>

      <label for="opcao">Tipo:</label>
      <select id="opcao" name="opcao" required>
        <option value="">Selecione</option>
        <option value="doar">Doar</option>
        <option value="trocar">Trocar</option>
        <option value="vender">Vender</option>
      </select>

      <div id="dinheiro-container" style="display: none;">
        <label for="preco">Preço:</label>
        <input type="text" id="preco" name="preco" placeholder="Preço" inputmode="decimal" required>
      </div>

      <div id="troca-container" style="display: none;">
        <label for="troca">Item para Troca:</label>
        <textarea id="troca" name="troca" placeholder="Item para Troca" required></textarea>
      </div>

      <div id="doacao-container" style="display: none;">
        <span>Doação não envolve valor monetário, contate pelo número contato.</span>
      </div>

      <button type="submit">Cadastrar</button>
    </form>

    <script>
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
        updateVisibility();
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