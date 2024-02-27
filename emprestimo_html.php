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
        <title>CADASTRAR EMPRESTIMO</title>

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
                <a class="nav-item nav-link" href="aluno_html.php">Cadastrar Aluno</a>
                <a class="nav-item nav-link active" href="emprestimo_html.php">Cadastrar Emprestimo</a>
                </div>
            </div>
            <div>
                <a href="sair.php" class="btn btn-danger">Sair</a>
            </div>
        </nav>

    </body>

    <body>

        <div>
            <a href="aluno_html.php" class="btn btn-outline-danger btn-voltar">🠔 Voltar</a>
        </div>

        <div class = "container">

            <div class = "tela-cadastro ">

                <form action="cadastro_emprestimo.php" method="POST">
                    <h2>Cadastrar Emprestimo</h2>
                    <br><br>
                    <h4>Emprestimo</h4>
                    <input autofocus type = "date" class="emprestimo" name="data_emprestimo" placeholder = "Data Emprestimo" required>
                    <input type = "date" class="emprestimo" name="data_devolucao" placeholder = "Data Devolução" required>
                    <select name="idlivro" id="idlivro" required>
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

                    <select name="idexemplar_livro" id="idexemplar_livro" required>
                        <option value="0" required></option>
                    </select>

                    <script>
                        // Quando o livro for selecionado, atualiza o segundo select com os exemplares correspondentes
                        document.getElementById("idlivro").addEventListener("change", function() {
                            var livroId = this.value;
                            var exemplarSelect = document.getElementById("idexemplar_livro");
                            
                            exemplarSelect.innerHTML = '<option value="0">Carregando...</option>';
                            
                            // Requisição ao AJAX para obter os exemplares do livro selecionado
                            var xhr = new XMLHttpRequest();
                            xhr.open("GET", "get_exemplares.php?livro_id=" + livroId, true);
                            xhr.onload = function() {
                                if (xhr.status === 200) {
                                    exemplarSelect.innerHTML = xhr.responseText;
                                } else {
                                    exemplarSelect.innerHTML = '<option value="0">Erro ao carregar exemplares</option>';
                                }
                            };
                            xhr.send();
                        });
                    </script>

                    <select name="idaluno" required>
                        <option value="0" required>Selecione o Aluno</option>
                        <?php
                            $mysqli = new mysqli('localhost', 'root', '', 'sistema_de_biblioteca');
                            $query = $mysqli->query("SELECT * FROM aluno");

                            while($aluno = mysqli_fetch_array($query))
                            {
                                echo '<option value="'.$aluno['idaluno'].'">'.$aluno['nome_aluno'].'</option>';
                            }
                        ?>
                    </select>
                    <br><br>
                    <input type="submit" class="cadastrar" name="cadastrar_emprestimo" value="Cadastrar Dados">
                </form> 

            </div>

            <div>

                <a href="menu.php" class="btn btn-dark btn-lg btn-proximo">Finalizar</a>

            </div>

        </div>
        
    </body>
          
</html>