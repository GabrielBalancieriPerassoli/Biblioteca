<?php

    require "cabecalho.php";
    require "conexao.php";
    require "verifica_sessao.php";

    if (isset($_SESSION["nome_usuario"]) && isset($_SESSION["senha"])) { 

        if (isset($_POST["cadastrar_autor"])) {

            $conexao = $_SESSION["conexao"];

            $idlivro = $_POST["idlivro"];
            $nome_autor = $_POST["nome_autor"];

            // Verificar se o autor já está cadastrado
            $sql_autor = "SELECT * FROM autor WHERE nome_autor = '{$nome_autor}'";
            $result_autor = mysqli_query($conexao, $sql_autor);

            if ($idlivro == 0) {
                // Livro não selecionado, exibir uma mensagem de erro ou redirecionar para a página anterior
                ?>
                    <script>
                        var msg = "Por favor, selecione um Livro.";
                        alert(msg);
                        window.location.href = "autor_html.php";
                    </script>
                <?php 
                exit;
            }
            elseif (mysqli_num_rows($result_autor) > 0) 
            {
                // O autor já está cadastrado, então vamos buscar o seu idautor
                $autor = mysqli_fetch_assoc($result_autor);
                $idautor = $autor["idautor"];
            } 
            else 
            {
                // O autor não está cadastrado, então vamos inseri-lo na tabela "autor"
                $sql_insert_autor = "INSERT INTO autor (nome_autor) VALUES ('{$nome_autor}')";
                $result_insert_autor = mysqli_query($conexao, $sql_insert_autor);
                $idautor = mysqli_insert_id($conexao);
            }

            // Inserir o relacionamento na tabela "autor_livro"
            $sql_relacionamento = "INSERT INTO autor_livro (autor_idautor, livro_idlivro) VALUES ('{$idautor}', '{$idlivro}')";
            $result_relacionamento = mysqli_query($conexao, $sql_relacionamento);

            ?>
            <script>
                var msg = "Cadastrado com Sucesso!";
                alert(msg);
                window.location.href = "exemplar_html.php";
            </script>
            <?php 
        }
        elseif(isset($_POST["listar_autor"]))
        {
            header("Location: pesquisa_autor.php");
        }
    }
?>

