<?php
session_start();
include_once('config.php'); // Assumindo que 'config.php' contém a conexão $conexao

if (isset($_POST['entrar']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    
    // 1. Limpeza de variáveis de sessão de erro
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    unset($_SESSION['erro_login']);

    $email = $_POST['email'];
    $senha_digitada = $_POST['senha']; // Usar um nome de variável diferente para evitar confusão

    // *** PASSO 1: PREPARAÇÃO DO STATEMENT ***
    // Usa '?' como placeholder para os valores
    $sql = "SELECT id, email, senha FROM cadastro WHERE email = ?";
    
    // Prepara a consulta
    $stmt = $conexao->prepare($sql); 
    
    if ($stmt === false) {
        // Tratar erro na preparação (Ex: erro de sintaxe na SQL)
        $_SESSION['erro_login'] = "Erro interno do sistema. Tente novamente.";
        header('Location: login.php');
        exit();
    }

    // *** PASSO 2: BIND DOS PARÂMETROS ***
    // 's' indica que o parâmetro é uma string (email)
    $stmt->bind_param("s", $email); 

    // *** PASSO 3: EXECUÇÃO DA CONSULTA ***
    $stmt->execute();

    // Obtém o resultado
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $usuario = $result->fetch_assoc();
        
        // *** PASSO 4: VERIFICAÇÃO DA SENHA (IMPORTANTE!) ***
        // É ALTAMENTE RECOMENDADO USAR password_verify() com senhas criptografadas 
        // (hash) no banco de dados.
        // A linha abaixo é APENAS uma correção de SQL Injection para o seu código atual.
        
        // Se a senha estiver armazenada em texto simples (MUITO RUIM!):
        if ($senha_digitada === $usuario['senha']) { 
        // OU a maneira CORRETA (se você usa hash):
        // if (password_verify($senha_digitada, $usuario['senha'])) {

            $_SESSION['id'] = $usuario['id']; 
            $_SESSION['email'] = $usuario['email'];
            
            // Removendo a senha da sessão por segurança
            // Se precisar, você pode definir $_SESSION['logado'] = true;

            $stmt->close();
            header('Location: home.php');
            exit(); 
        } else {
             // Senha incorreta
            $_SESSION['erro_login'] = "Email ou senha incorretos.";
            $stmt->close();
            header('Location: login.php');
            exit(); 
        }

    } else {
        // Email não encontrado ou mais de um resultado (o que é um erro)
        $_SESSION['erro_login'] = "Email ou senha incorretos.";
        $stmt->close();
        header('Location: login.php');
        exit();
    }

} else {
    // Campos vazios
    $_SESSION['erro_login'] = "Preencha o email e a senha para fazer login.";
    header('Location: login.php');
    exit();
}
?>