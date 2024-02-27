<?php

    require "cabecalho.php";
    require "verifica_sessao.php";
    require "conexao.php";

    if((!isset($_SESSION["nome_usuario"]) == true) and (!isset($_SESSION["senha"]) == true))
    {
        unset($_SESSION["nome_usuario"]);
        unset($_SESSION["senha"]);
        header("Location: login.php");
    }

?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <link rel="stylesheet" href="css/style.css">
        <title>CADASTRAR EDITORA</title>

    </head>

<body class= "corpo">

    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link" href="menu.php">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link active" href="editora_html.php">Cadastrar Editora</a>
            </div>
        </div>
        <div>
            <a href="sair.php" class="btn btn-danger">Sair</a>
        </div>
    </nav>

</body>
<body>
    
    <div>
        <a href="voltar.php" class="btn btn-outline-danger btn-voltar">🠔 Voltar</a>
    </div>

    <div class="container">
        <div class = "tela-cadastro ">

            <form action="cadastro_editora.php" method="POST">
                <h2>Cadastrar Editora</h2>
                <br><br>
                <h4>Editora</h4>
                <input autofocus autocomplete = "off" type = "text" class="editora" name="nome_editora" placeholder = "Nome Editora" required>
                <br><br>
                <input type="submit" class="cadastrar" name="cadastrar_editora" value="Cadastrar Dados">
            </form>

        </div>

        <div>

            <a href="livro_html.php" class="btn btn-danger btn-lg btn-proximo">Próximo ➜</a>

        </div>

    </div>

</body>
</html>