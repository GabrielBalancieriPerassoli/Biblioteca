<?php

    require "cabecalho.php";
    require "conexao.php";
    require "verifica_sessao.php";
  
    if (isset($_SESSION["nome_usuario"]) && isset($_SESSION["senha"])) {

        if (isset($_POST["cadastrar_exemplar"])) 
        {
            $conexao = $_SESSION["conexao"];

            $numero_exemplar = $_POST["numero_exemplar"];

            $idlivro = $_POST["idlivro"];

            $sql_ex = "SELECT * FROM exemplar_livro WHERE numero_exemplar = '{$numero_exemplar}'";
            $result_ex = mysqli_query($conexao, $sql_ex);

            if ($idlivro == 0) {
                // Livro não selecionado, exibir uma mensagem de erro ou redirecionar para a página anterior
                ?>
                    <script>
                        var msg = "Por favor, selecione um Livro.";
                        alert(msg);
                        window.location.href = "exemplar_html.php";
                    </script>
                <?php 
                exit;
            }
            elseif ($result_ex->num_rows > 0)
            {

                $livro_duplicado = false;

                while ($row = mysqli_fetch_assoc($result_ex)) 
                {

                    if ($row["idlivro"] == $idlivro) 
                    {

                        $livro_duplicado = true;
                        break;

                    }

                }
            
                if ($livro_duplicado) 
                
                {
                    ?>
                    <script>
                        var msg = "Este livro já foi cadastrado.";
                        alert(msg);
                        window.location.href = "exemplar_html.php";
                    </script>
                    <?php 
                    exit;
                    
                }

            }

            // Inserir a exemplar na tabela EXEMPLAR
            $sql_exemplar = "INSERT INTO EXEMPLAR_LIVRO (idlivro, numero_exemplar) VALUES ('{$idlivro}', '{$numero_exemplar}')";
            $result_exemplar = mysqli_query($conexao, $sql_exemplar);
            $idexemplar_livro = mysqli_insert_id($conexao);

            ?>
                <script>
                    var msg = "Cadastrado com Sucesso!";
                    alert(msg);
                    window.location.href = "aluno_html.php";
                </script>
            <?php 
            
        }
        elseif(isset($_POST["listar_exemplar"]))
        {
            header("Location: pesquisa_exemplar.php");
        }

    }
    else 
    {
        header("Location: index.php");
    }
?>