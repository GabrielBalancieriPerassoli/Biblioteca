<?php

    require "cabecalho.php";
    require "conexao.php";
    require "verifica_sessao.php";

    if (isset($_SESSION["nome_usuario"]) && isset($_SESSION["senha"])) { 

        if (isset($_POST["cadastrar_aluno"])) {

            $conexao = $_SESSION["conexao"];

            $nome_aluno = $_POST["nome_aluno"];
            $cpf = $_POST["cpf"];
            $ra = $_POST["ra"];

            // Verificação se já existe um CPF ou RA igual no banco de dados
            $sql_cpf = "SELECT * FROM aluno WHERE cpf = '{$cpf}'";
            $result_cpf = mysqli_query($conexao, $sql_cpf);

            $sql_ra = "SELECT * FROM aluno WHERE ra = '{$ra}'";
            $result_ra = mysqli_query($conexao, $sql_ra);

            if(mysqli_num_rows($result_cpf) == 1)
            {
                ?>
                    <script>
                        var msg = "Não foi possível cadastrar pois já existe um CPF igual!";
                        alert(msg);
                        window.location.href = "aluno_html.php";
                    </script>
                <?php 
            }
            elseif(mysqli_num_rows($result_ra) == 1)
            {
                ?>
                <script>
                    var msg = "Não foi possível cadastrar pois já existe um RA igual!";
                    alert(msg);
                    window.location.href = "aluno_html.php";
                </script>
                <?php   
            }
            else
            {

                // Inserir o aluno na tabela ALUNO
                $sql_aluno = "INSERT INTO ALUNO (nome_aluno, cpf, ra) VALUES ('{$nome_aluno}', '{$cpf}', '{$ra}')";
                $result_aluno = mysqli_query($conexao, $sql_aluno);
                $idaluno = mysqli_insert_id($conexao);

                ?>
                <script>
                    var msg = "Cadastrado com Sucesso!";
                    alert(msg);
                    window.location.href = "emprestimo_html.php";
                </script>
                <?php

            }
        }
        elseif(isset($_POST["listar_aluno"]))
        {
            header("Location: pesquisa_aluno.php");
        }
    }
?>