<?php 
    require "cabecalho.php";
    require "verifica_sessao.php";

    if((!isset($_SESSION["nome_usuario"]) == true) and (!isset($_SESSION["senha"]) == true))
    {
        unset($_SESSION["nome_usuario"]);
        unset($_SESSION["senha"]);
        header("Location: login.php");
    }
    $usuario_logado = $_SESSION["nome_usuario"];
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>MENU</title>

    </head>

    <body class= "corpo">
        
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" href="menu.php">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="editora_html.php">Cadastrar Editora</a>
                </div>
            </div>
            <div>
                <a href="sair.php" class="btn btn-danger">Sair</a>
            </div>
        </nav>
        <br><br>
        <div class= "bem-vindo">
            <?php
                echo "<h2>Bem vindo $usuario_logado!</h2>";
            ?>
        </div>
        <div class = "listar-container">

            <div class = "listar">

                <form action="cadastro_editora.php" method="POST">
                    <input type="submit" class="listar_editora" name="listar_editora" value="Listar Editoras">
                </form>
                
            </div>

            <div class = "listar">

                <form action="cadastro_livro.php" method="POST">
                    <input type="submit" class="listar_livro" name="listar_livro" value="Listar Livros">
                </form>

            </div>  

            <div class = "listar">

                <form action="cadastro_autor.php" method="POST">
                    <input type="submit" class="listar_autor" name="listar_autor" value="Listar Autores">
                </form>

            </div>

            <div class = "listar">

                <form action="cadastro_exemplar.php" method="POST">
                    <input type="submit" class="listar_exemplar" name="listar_exemplar" value="Listar Exemplares">
                </form>

            </div>

            <div class = "listar">

                <form action="cadastro_aluno.php" method="POST">
                    <input type="submit" class="listar_aluno" name="listar_aluno" value="Listar Alunos">
                </form>

            </div>

            <div class = "listar">

                <form action="cadastro_emprestimo.php" method="POST">
                    <input type="submit" class="listar_emprestimo" name="listar_emprestimo" value="Listar Emprestimos">
                </form>

            </div>
            
        </div>

    </body>
</html>