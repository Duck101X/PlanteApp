<?php
if (isset($_POST['cadastrar'])) {
  include_once('config.php');

  $nome  = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  // validação de email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $msg_email = "E-mail inválido!";
  } else {
    $msg_email = "";
  }

  // 1. Verifique se o email já existe no banco de dados
  $check_email_query = "SELECT COUNT(*) FROM cadastro WHERE email = ?";
  $stmt = mysqli_prepare($conexao, $check_email_query);
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $count);
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);

  if ($count > 0) {
    $msg_email = "Este e-mail já está cadastrado!";
  }

  // Se houver uma mensagem de erro, exiba-a via JavaScript
  if (!empty($msg_email)) {
    echo "<script>alert('{$msg_email}');</script>";
  }
  // Se não houver erro, faça o cadastro e o redirecionamento
  else {
    $insert_query = "INSERT INTO cadastro(nome, email, senha) VALUES (?, ?, ?)";
    $stmt_insert = mysqli_prepare($conexao, $insert_query);
    mysqli_stmt_bind_param($stmt_insert, "sss", $nome, $email, $senha);
    mysqli_stmt_execute($stmt_insert);
    mysqli_stmt_close($stmt_insert);

    echo "<script>alert('Cadastro realizado com sucesso!');</script>";
    echo "<script>window.location.href = 'login.php';</script>";
    exit(); // Garante que o script pare aqui
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../CSS/cadastro.css" />
  <link rel="icon" type="image/png" href="../img/icon.png">
  <title>Cadastro - PlanteApp</title>
</head>

<body>
  <header>
    <div class="logo">
      <img src="../img/folha.png" alt="Logo" />
      <a href="../index.php">PlanteApp</a>
    </div>
    <nav>
      <a href="../index.php">Home</a>
      <a href="../Login/cadastro.php">Cadastrar-se</a>
      <a href="../Login/login.php">Entrar</a>
    </nav>
  </header>

  <div class="container">
    <img src="../img/cadastro.png" alt="cada" />
    <h2>Crie sua conta</h2>
    <form action="../Login/cadastro.php" method="POST">
      <input type="text" name="nome" id="nome" class="InputUser" placeholder="Nome completo" required />
      <small class="msg-erro">
        <?= isset($msg_email) ? $msg_email : '' ?>
      </small>
      <input type="email" name="email" id="email" placeholder="E-mail"
        value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required>

      <div style="position:relative;">
        <input type="password" id="senha" name="senha" placeholder="Senha" required style="width:100%;" pattern="^(?=.*[A-Z])(?=.*[\W_]).{8,}$"
          title="A senha deve ter no mínimo 8 caracteres, uma letra maiúscula e um caractere especial."/>
        <button type="button" class="btn-olho" onclick="mostrarSenha()">
          <img id="icone-olho" src="../img/olho.png" alt="Mostrar senha"></button>
      </div>
      <input type="text" id="confirmar-senha" name="confirmar-senha" placeholder="Confirmar Senha" required style="width:100%;" />
      <button type="submit" name="cadastrar" id="cadastrar">Cadastrar</button>
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

    document.querySelector('form').addEventListener('submit', function(e) {
      const senha = document.getElementById('senha').value;
      const confirmar = document.getElementById('confirmar-senha').value;
      if (senha !== confirmar) {
        e.preventDefault();
        alert('As senhas devem coincidir.');
        document.getElementById('senha').value = '';
        document.getElementById('confirmar-senha').value = '';

      }
    });
  </script>
</body>

</html>