<?php

    require "cabecalho.php";
    require "conexao.php";
    require "verifica_sessao.php";

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
        <title>CADASTRAR LIVRO</title>

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
                <a class="nav-item nav-link active" href="livro_html.php">Cadastrar Livro</a>
                </div>
            </div>
            <div>
                <a href="sair.php" class="btn btn-danger">Sair</a>
            </div>
        </nav>

    </body>
    
    <body>

        <div>
            <a href="editora_html.php" class="btn btn-outline-danger btn-voltar">🠔 Voltar</a>
        </div>

        <div class = "container">
            
            <div class = "tela-cadastro ">

                <form action="cadastro_livro.php" method="POST">

                    <h2>Cadastrar Livro</h2>
                    <br><br>
                    <h4>Livro</h4>
                    <input autofocus autocomplete = "off" type = "text" class="livro" name="nome_livro" placeholder = "Nome Livro" required>
                    <input type = "text" class="livro" name="ano_publicacao" placeholder = "Ano" required/>
                    <select name="ideditora" required>
                        <option value="0" required>Selecione a Editora</option>
                        <?php
                            $mysqli = new mysqli('localhost', 'root', '', 'sistema_de_biblioteca');
                            $query = $mysqli->query("SELECT * FROM editora");

                            while($editora = mysqli_fetch_array($query))
                            {
                                echo '<option value="'.$editora['ideditora'].'">'.$editora['nome_editora'].'</option>';
                            }
                        ?>
                    </select>
                    <br><br>
                    <input type="submit" class="cadastrar" name="cadastrar_livro" value="Cadastrar Dados">

                </form> 

            </div>

            <div>

                <a href="autor_html.php" class="btn btn-danger btn-lg btn-proximo">Próximo ➜</a>

            </div>

        </div>
    </body>          
</html>