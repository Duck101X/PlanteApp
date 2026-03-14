<?php
session_start();
require_once __DIR__ . '/../Login/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salvar'])) {
    $idplantas = (int)$_POST['idplantas'];
    $nome      = trim($_POST['nome']);
    $tipo      = trim($_POST['tipo']);
    $telefone  = trim($_POST['telefone']);
    $descricao = trim($_POST['descricao']);
    $opcao     = $_POST['opcao'];

    // Limpa os valores para evitar problemas futuros
    $preco = null;
    $troca = null;

    // Atribui o valor correto com base na opção selecionada E O PROCESSA
    if ($opcao === 'vender' && isset($_POST['preco']) && !empty($_POST['preco'])) {
        // Remove 'R$', espaços, pontos e troca vírgula por ponto para o banco
        $preco = str_replace(['R$', ' ', '.'], '', $_POST['preco']);
        $preco = str_replace(',', '.', $preco);
        // O valor agora está limpo e formatado como um decimal para o banco
    } elseif ($opcao === 'trocar' && isset($_POST['troca']) && !empty($_POST['troca'])) {
        $troca = trim($_POST['troca']);
    }

    // Tenta processar nova imagem (se enviada)
    $novaFoto = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK && $_FILES['foto']['size'] > 0) {
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg','jpeg','png','webp'];
        if (in_array($ext, $permitidas, true)) {
            $dirUploads = __DIR__ . '/uploads';
            if (!is_dir($dirUploads)) {
                mkdir($dirUploads, 0775, true);
            }
            $novoNome = uniqid('planta_', true) . '.' . $ext;
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $dirUploads . '/' . $novoNome)) {
                // No banco salvamos só o NOME do arquivo (não o caminho)
                $novaFoto = $novoNome;
            }
        }
    }

    // Lógica para preparar e executar o UPDATE
    if ($novaFoto !== null) {
        // Atualiza tudo, incluindo a foto
        $sql = "UPDATE plantas
                    SET nome=?, tipo=?, telefone=?, descricao=?, opcao=?, preco=?, troca=?, foto=?
                  WHERE idplantas=?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssssssssi",
            $nome, $tipo, $telefone, $descricao, $opcao, $preco, $troca, $novaFoto, $idplantas
        );
    } else {
        // NÃO mexe na foto se não houve novo upload
        $sql = "UPDATE plantas
                    SET nome=?, tipo=?, telefone=?, descricao=?, opcao=?, preco=?, troca=?
                  WHERE idplantas=?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sssssssi",
            $nome, $tipo, $telefone, $descricao, $opcao, $preco, $troca, $idplantas
        );
    }

    if ($stmt->execute()) {
        header("Location: listar-plantas.php");
        exit;
    } else {
        echo "❌ Erro ao atualizar planta: " . $stmt->error;
    }
    
    $stmt->close();
    $conexao->close();
}
?>