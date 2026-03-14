<?php
session_start();
include_once(__DIR__ . '/../Login/config.php');

// Inicialize as variáveis com null
$preco = null;
$troca = null;

// Receber os dados do formulário
$usuario_id = $_SESSION['id'];
$nome = $_POST['nome'];
$tipo = $_POST['tipo'];
$telefone = $_POST['telefone'];
$descricao = $_POST['descricao'];
$opcao = $_POST['opcao'];

// Atribuir o valor correto com base na opção selecionada
if ($opcao === 'vender' && isset($_POST['preco'])) {
    // Processa e atribui o valor do preço apenas se a opção 'vender' for selecionada
    $preco = str_replace(['R$', ' ', '.'], '', $_POST['preco']);
    $preco = str_replace(',', '.', $preco);
    $preco = floatval($preco);
} elseif ($opcao === 'trocar' && isset($_POST['troca'])) {
    // Atribui o valor do item de troca
    $troca = $_POST['troca'];
}

// Processar a imagem
$foto_nome = $_FILES['foto']['name'];
$foto_temp = $_FILES['foto']['tmp_name'];
$caminho_foto = "uploads/" . basename($foto_nome);

// Criar a pasta se não existir
if (!is_dir("uploads")) {
    mkdir("uploads", 0777, true);
}

// Mover a imagem para o destino
if (move_uploaded_file($foto_temp, $caminho_foto)) {
    // Inserir no banco de dados
    $sql = "INSERT INTO plantas (nome, tipo, telefone, descricao, foto, opcao, preco, usuario_id, troca) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssssssis", $nome, $tipo, $telefone, $descricao, $foto_nome, $opcao, $preco, $usuario_id, $troca);
    
    if ($stmt->execute()) {
        header('Location: ../Planta/listar-plantas.php');
    } else {
        echo "❌ Erro ao cadastrar planta: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "❌ Erro ao enviar a imagem.";
}

$conexao->close();
?>