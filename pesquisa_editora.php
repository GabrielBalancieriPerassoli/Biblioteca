<?php

    require "conexao.php";
    require "cabecalho.php";

    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql = "SELECT * FROM editora WHERE ideditora LIKE '%$data%' or nome_editora LIKE '%$data%' ORDER BY ideditora DESC";

    }
    else
    {
        $sql = "SELECT * FROM editora ORDER BY ideditora DESC";
    }

    $result = $conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <link rel="stylesheet" href="css/style.css">
        <title>LISTAR EDITORA</title>

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
                        <th scope="col">Nome Editora</th>
                        <th scope="col">Editar</th>
                    </tr>
                </thead>
                <tbody>;
                <?php
                while ($user_data = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $user_data['ideditora'] . '</td>';
                    echo '<td>' . $user_data['nome_editora'] . '</td>';
                    echo '<td>
                        <a class="btn btn-sm btn-info btn-group" href="edit_editora.php?ideditora=' . $user_data['ideditora'] . '">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                            </svg>
                        </a>
                    </td>
                    </tr>';
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
                window.location = 'pesquisa_editora.php?search='+search.value;
            }
    </script>
    
</html>  