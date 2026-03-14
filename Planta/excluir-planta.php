<?php

$nome = $tipo = $telefone = $descricao = $opcao = $preco = $foto = "";

if (!empty($_GET['idplantas'])) {
    include_once(__DIR__ . '/../Login/config.php');
    $idplantas = $_GET['idplantas'];
    $sqlDelete = "DELETE FROM plantas WHERE idplantas = $idplantas";
    $result = $conexao->query($sqlDelete);

    
    if ($result) {
        header("Location: listar-plantas.php");
        exit();
    } else {
        echo "Erro ao excluir planta.";
        exit();
    }
}

?>
