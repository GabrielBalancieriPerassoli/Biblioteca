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
        <title>CADASTRAR AUTOR</title>

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
                <a class="nav-item nav-link active" href="autor_html.php">Cadastrar Autor</a>
                </div>
            </div>
            <div>
                <a href="sair.php" class="btn btn-danger">Sair</a>
            </div>
        </nav>

    </body>

    <body>

        <div>
            <a href="livro_html.php" class="btn btn-outline-danger btn-voltar">🠔 Voltar</a>
        </div>

        <div class = "container">

            <div class = "tela-cadastro ">

                <form action="cadastro_autor.php" method="POST">
                    <h2>Cadastrar Autor</h2>
                    <br><br>
                    <h4>Autor</h4>
                    <input autofocus autocomplete = "off" type = "text" class="autor" name="nome_autor" placeholder = "Nome Autor" required>
                    <select name="idlivro" required>
                        <option value="0" required>Selecione o Livro</option>
                        <?php
                            $mysqli = new mysqli('localhost', 'root', '', 'sistema_de_biblioteca');
                            $query = $mysqli->query("SELECT * FROM livro");

                            while($livro = mysqli_fetch_array($query))
                            {
                                echo '<option value="'.$livro['idlivro'].'">'.$livro['nome_livro'].'</option>';
                            }
                        ?>
                    </select>
                    <br><br>
                    <input type="submit" class="cadastrar" name="cadastrar_autor" value="Cadastrar Dados">
                </form> 

            </div>

            <div>

                <a href="exemplar_html.php" class="btn btn-danger btn-lg btn-proximo">Próximo ➜</a>

            </div>
            
        </div>
    </body>
              
</html>