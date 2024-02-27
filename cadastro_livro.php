<?php

    require "verifica_sessao.php";
    require "cabecalho.php";
    require "conexao.php";

    if (isset($_SESSION["nome_usuario"]) && isset($_SESSION["senha"])) { 
        
        if (isset($_POST["cadastrar_livro"])) {

            $conexao = $_SESSION["conexao"];

            $nome_livro = $_POST["nome_livro"];
            $ano_publicacao = $_POST["ano_publicacao"];

            $ideditora = $_POST["ideditora"];

            if ($ideditora == 0) {
                // Editora não selecionada, exibir uma mensagem de erro ou redirecionar para a página anterior
                ?>
                    <script>
                        var msg = "Por favor, selecione uma Editora.";
                        alert(msg);
                        window.location.href = "livro_html.php";
                    </script>
                <?php 
                exit;
            }

            // Verificação se já existe um nome de livro igual no banco de dados
            $sql = "SELECT * FROM livro WHERE nome_livro = '{$nome_livro}'";
            $result = mysqli_query($conexao, $sql);
            

            if(mysqli_num_rows($result) == 1)
            {
                ?>
                    <script>
                        var msg = "Não foi possível cadastrar pois já existe!";
                        alert(msg);
                        window.location.href = "livro_html.php";
                    </script>
                <?php 
            }
            else
            {

                // Inserir o livro na tabela LIVRO
                $sql_livro = "INSERT INTO LIVRO (ideditora, nome_livro, ano_publicacao) VALUES('{$ideditora}', '{$nome_livro}', '{$ano_publicacao}')";
                $result_livro = mysqli_query($conexao, $sql_livro);
                $idlivro = mysqli_insert_id($conexao);

                ?>
                    <script>
                        var msg = "Cadastrado com Sucesso!";
                        alert(msg);
                    window.location.href = "autor_html.php";
                    </script>
                <?php 
            }
        }
        elseif(isset($_POST["listar_livro"]))
        {
            header("Location: pesquisa_livro.php");  
        }
    }
?>