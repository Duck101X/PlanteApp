<?php
include_once(__DIR__ . '/Login/config.php');

$busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';

if (!empty($busca)) {
    $sql = "SELECT plantas.*, cadastro.Nome AS nome_usuario 
            FROM plantas 
            JOIN cadastro ON plantas.usuario_id = cadastro.id
            WHERE plantas.nome LIKE ? 
            OR plantas.descricao LIKE ? 
            OR plantas.tipo LIKE ?";
    $stmt = $conexao->prepare($sql);
    $likeBusca = "%{$busca}%";
    $stmt->bind_param("sss", $likeBusca, $likeBusca, $likeBusca);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT plantas.*, cadastro.Nome AS nome_usuario 
            FROM plantas 
            JOIN cadastro ON plantas.usuario_id = cadastro.id";
    $result = $conexao->query($sql);
}

if ($result->num_rows > 0) {
    while ($planta = $result->fetch_assoc()) {
        echo '<div class="produto">';
        echo    '<img src="Planta/uploads/'. htmlspecialchars($planta['foto']) . '" alt="Foto da planta">';
        echo    '<h3>' . htmlspecialchars($planta['nome']) . '</h3>';
        echo    '<p>' . htmlspecialchars($planta['descricao']) . '</p>';
        echo    '<p><strong>Tipo:</strong> ' . htmlspecialchars($planta['tipo']) . '</p>';
        echo    '<p><strong>Dono:</strong> ' . htmlspecialchars($planta['nome_usuario']) . '</p>';
        echo    '<p><strong>Opção:</strong> ' . htmlspecialchars($planta['opcao']) . '</p>';
        echo    '<span class="preco">R$: ' . number_format($planta['preco'], 2, ',', '.') . '</span>';
        echo    '<a class="botaoProduto" href="negociar-index.php?idplantas=' . $planta['idplantas'] . '">Negociar</a>';
        echo '</div>';
    }
} else {
    echo '<p>Nenhuma planta encontrada.</p>';
}
?>
