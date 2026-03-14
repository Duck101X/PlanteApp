<?php
    // ESSENCIAL: session_start() deve ser a PRIMEIRA coisa na página.
    session_start();

    // Inicia a variável $mensagem_erro como vazia
    $mensagem_erro = ''; 

    if (isset($_SESSION['erro_login'])) {
        $mensagem_erro = $_SESSION['erro_login'];
        // Limpa a variável de sessão para que a mensagem só apareça uma vez
        unset($_SESSION['erro_login']); 
    }
?>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../CSS/Login.css" />
  <link rel="icon" type="../image/png" href="img/icon.png">
  <title>Login - PlanteApp</title>
</head>
<body>
  <header>
    <div class="logo">
      <img src="../img/folha.png" alt="Logo" />
      <a href="../index.php">PlanteApp</a>
    </div>
    <nav>
      <a href="../index.php">Home</a>
      <a href="cadastro.php">Cadastrar-se</a>
      <a href="login.php">Entrar</a>
    </nav>
  </header>
  <div class="container">
    <img src="../img/cadastro.png" class="cada"/>
    <h2>Entrar na conta</h2>
    
    <?php 
        // Exibe a div de erro AQUI, logo antes do formulário
        if ($mensagem_erro) { 
    ?>
      <div style="
          background-color: #f8d7da; 
          color: #721c24; 
          border: 1px solid #f5c6cb; 
          padding: 10px; 
          margin-bottom: 15px; 
          border-radius: 5px;
          text-align: center;
          /* Adicionando margem para centralizar melhor */
          margin: 10px auto; 
          max-width: 300px;
      ">
          <?php echo htmlspecialchars($mensagem_erro); ?>
      </div>
    <?php } ?>

    <form action="testelogin.php" method="POST">      
      <input type="email" id="email" name="email" placeholder="E-mail" required />
        <div style="position:relative;">
          <input type="password" id="senha" name="senha" placeholder="Senha" required style="width:100%;"/>
          <button type="button" class="btn-olho" onclick="mostrarSenha()">
          <img id="icone-olho" src="../img/olho.png" alt="Mostrar senha"></button>
        </div>
      <input class="botao" type="submit" id="entrar" name="entrar" value="Entrar" />
    </form>
  </div>
  <script>
    function mostrarSenha() {
      var senha = document.getElementById("senha");
      var icone = document.getElementById("icone-olho");
      if (senha.type === "password") {
        senha.type = "text";
        icone.src = "../img/olho-marcado.png";
      } else {
        senha.type = "password";
        icone.src = "../img/olho.png";
      }
    }
  </script>
</body>
</html>