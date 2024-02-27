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
        <title>CADASTRAR ALUNO</title>

    </head>

    <body class= "corpo">

        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                <a class="nav-item nav-link" href="menu.php">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="editora_html.php">Cadastrar Editora</a>
                <a class="nav-item nav-link" href="livro_html.php">Cadastrar Livro</a>
                <a class="nav-item nav-link" href="autor_html.php">Cadastrar Autor</a>
                <a class="nav-item nav-link" href="exemplar_html.php">Cadastrar Exemplar</a>
                <a class="nav-item nav-link active" href="aluno_html.php">Cadastrar Aluno</a>
                </div>
            </div>
            <div>
                <a href="sair.php" class="btn btn-danger">Sair</a>
            </div>
        </nav>

    </body>

    <body>

        <div>
            <a href="exemplar_html.php" class="btn btn-outline-danger btn-voltar">🠔 Voltar</a>
        </div>

        <div class = "container">

            <div class = "tela-cadastro ">

                <form action="cadastro_aluno.php" method="POST">
                    <h2>Cadastrar Aluno</h2>
                    <br><br>
                    <h4>Aluno</h4>
                    <input autofocus autocomplete = "off" type = "text" class="aluno" name="nome_aluno" placeholder = "Nome Aluno" required>
                    <input autocomplete = "off" type = "text" class="aluno" name="cpf" placeholder = "Cpf" required/>
                    <input autocomplete = "off" type = "text" class="aluno" name="ra" placeholder = "Ra" required/>
                    <br><br>
                    <input type="submit" class="cadastrar" name="cadastrar_aluno" value="Cadastrar Dados">
                </form> 

            </div>

            <div>

                <a href="emprestimo_html.php" class="btn btn-danger btn-lg btn-proximo">Próximo ➜</a>

            </div>
            
        </div>
    </body>    

</html>