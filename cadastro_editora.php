<?php

    require "verifica_sessao.php";
    require "cabecalho.php";
    require "conexao.php";

    if (isset($_SESSION["nome_usuario"]) && isset($_SESSION["senha"])) { 
           
        if (isset($_POST["cadastrar_editora"])) 
        {

            $conexao = $_SESSION["conexao"];
        
            $nome_editora = $_POST["nome_editora"];

            $sql = "SELECT * FROM editora WHERE nome_editora = '{$nome_editora}'";
            $result = mysqli_query($conexao, $sql);
            

            if(mysqli_num_rows($result) == 1)
            {
                ?>
                    <script>
                        var msg = "Não foi possível cadastrar pois já existe!";
                        alert(msg);
                        window.location.href = "editora_html.php";
                    </script>
                <?php 
            }
            else
            {
                    
                // Inserir a editora na tabela EDITORA
                $sql_editora = "INSERT INTO EDITORA (nome_editora) VALUES ('{$nome_editora}')";
                $result_editora = mysqli_query($conexao, $sql_editora);
                $ideditora = mysqli_insert_id($conexao);

                ?>
                    <script>
                        var msg = "Cadastrado com Sucesso!";
                        alert(msg);
                        window.location.href = "livro_html.php";
                    </script>
                <?php 
            }
        }
        elseif(isset($_POST["listar_editora"]))
        {
            header("Location: pesquisa_editora.php");
        }
    }
    else 
    {
        header("Location: index.php");
    }
?>