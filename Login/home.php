<?php
    session_start();
    //print_r($_SESSION);
 
    if (!isset($_SESSION['email']) and !isset($_SESSION['senha'])) {
        header('Location: login.php');
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        exit();
    }
    $login = $_SESSION['email'];
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlanteApp</title>
    <link rel="stylesheet" href="../CSS/visual1.css">
    <link rel="stylesheet" href="../CSS/BlocoProduto.css">
    <link rel="icon" type="image/png" href="../img/icon.png">
</head>

<body>
    <header>
        <div class="logo-titulo">
            <img class="logo" src="../img/folha.png" alt="plantalogo">
            <h1>PlanteApp</h1>
        </div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="../Planta/listar-plantas.php">Minhas Plantas</a></li>
                <li><a href="../Planta/cadastrar-planta.php">Cadastrar-Planta</a></li>
                <li><a href="sair.php">Sair</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <div class="plantamini">
                <img src="../img/plantamini.png" alt="plantamini">
            </div>
            <h2>Troque ou doe<br>mudas!</h2>
            <div>
                <a href="../img/Mapa.png" class="mapa">Ver mapa</a>
            </div>
        </section>
            <div class="img-plantas">
                <img src="../img/3plantas.png" alt="Plantas">
            </div>
        <section class="destaques">
            <h2>Destaques</h2>
        </section>
            <form class="search-bar" method="GET" action="">
                <input type="text" name="busca" placeholder="Buscar planta..." value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>">
            <button type="submit">Pesquisar</button>
        </form>
        <section>

            <div class="container">
                <div class="grade-produtos">

                
                    <!-- Resultados da busca aparecerão aqui -->
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 PlanteApp. Todos os direitos reservados.</p>
    </footer>

    <script>
    // Carrega o feed completo ao abrir a página
    window.addEventListener('DOMContentLoaded', function() {
        fetch('../Planta/buscar-plantas.php')
            .then(response => response.text())
            .then(html => {
                document.querySelector('.grade-produtos').innerHTML = html;
            });
    });

    // Busca filtrada sem atualizar a página
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        const busca = document.querySelector('input[name="busca"]').value;
        fetch('../Planta/buscar-plantas.php?busca=' + encodeURIComponent(busca))
            .then(response => response.text())
            .then(html => {
                document.querySelector('.grade-produtos').innerHTML = html;
            });
    });
    </script>
    </main>

</body>

</html>