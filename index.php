<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlanteApp</title>
    <link rel="stylesheet" href="CSS/visual1.css">
    <link rel="stylesheet" href="CSS/BlocoProduto.css">
    <link rel="icon" type="image/png" href="img/icon.png">
</head>

<body>
    <header>
        <div class="logo-titulo">
            <img class="logo" src="img/folha.png" alt="plantalogo">
            <h1>PlanteApp</h1>
        </div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="Login/cadastro.php">Cadastrar-se</a></li>
                <li><a href="Login/login.php">Entrar</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <div class="plantamini">
                <img src="img/plantamini.png" alt="plantamini">
            </div>
            <h2>Troque ou doe<br>mudas!</h2>
            <div>
                <a href="img/Mapa.png" class="mapa">Ver mapa</a>
            </div>
            <div class="img-plantas">
                <img src="img/3plantas.png" alt="Plantas">
            </div>
        </section>
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
        fetch('buscar-plantas-index.php')
            .then(response => response.text())
            .then(html => {
                document.querySelector('.grade-produtos').innerHTML = html;
            });
    });

    // Busca filtrada sem atualizar a página
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        const busca = document.querySelector('input[name="busca"]').value;
        fetch('buscar-plantas-index.php?busca=' + encodeURIComponent(busca))
            .then(response => response.text())
            .then(html => {
                document.querySelector('.grade-produtos').innerHTML = html;
            });
    });
    </script>
</body>

</html>