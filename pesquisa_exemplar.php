<?php

    require "conexao.php";
    require "cabecalho.php";

    $search = '';
    if (!empty($_GET['search'])) {
        $search = $_GET['search'];
    }

    $sql_pesquisa = "SELECT exemplar_livro.idexemplar_livro, exemplar_livro.numero_exemplar, livro.nome_livro
            FROM exemplar_livro
            JOIN livro ON exemplar_livro.idlivro = livro.idlivro
            WHERE exemplar_livro.idexemplar_livro LIKE '%$search%' OR exemplar_livro.numero_exemplar LIKE '%$search%' OR livro.nome_livro LIKE '%$search%'
            ORDER BY exemplar_livro.idexemplar_livro DESC";

    $result_pesquisa = mysqli_query($conexao, $sql_pesquisa);

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <link rel="stylesheet" href="css/style.css">
        <title>LISTAR EXEMPLAR</title>

    </head>

    <body class= "corpo">

        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="menu.php">Home <span class="sr-only">(current)</span></a>
                </div>
            </div>
            <div>
                <a href="sair.php" class="btn btn-danger">Sair</a>
            </div>
        </nav>

    </body>

    <div>
        <a href="voltar.php" class="btn btn-outline-danger btn-voltar">🠔 Voltar</a>
    </div>

    <div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()" class="btn btn-dark">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>

    <body>
        <div class="content-container">
            <div class="table-container">
                <table class="table table-dark table-sm text-center">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Número Exemplar</th>
                        <th scope="col">Livro</th>
                    </tr>
                </thead>
                <tbody>
                <?php

                    while ($user_data = mysqli_fetch_assoc($result_pesquisa)) {
                        echo '<tr>';
                        echo '<td>' . $user_data['idexemplar_livro'] . '</td>';
                        echo '<td>' . $user_data['numero_exemplar'] . '</td>';
                        echo '<td>' . $user_data['nome_livro'] . '</td>';
                        echo '</tr>';
                    }
                ?>
                </tbody>
                </table>
            </div>
        </div>
    </body>

    <script>
            var search = document.getElementById("pesquisar");

            search.addEventListener("keydown", function(event) {
                if(event.key == "Enter")
                {
                    searchData();
                }
            })

            function searchData()
            {
                window.location = 'pesquisa_exemplar.php?search='+search.value;
            }
    </script>
    
</html>  