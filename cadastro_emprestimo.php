<?php

    require "verifica_sessao.php";
    require "cabecalho.php";
    require "conexao.php";

    if (isset($_SESSION["nome_usuario"]) && isset($_SESSION["senha"])) {

        if (isset($_POST["cadastrar_emprestimo"])) {

            $conexao = $_SESSION["conexao"];

            $idlivro = $_POST['idlivro'];

            $data_emprestimo = $_POST['data_emprestimo'];
            $data_devolucao = $_POST['data_devolucao'];

            $idexemplar_livro = $_POST['idexemplar_livro'];
            $idaluno = $_POST['idaluno'];

            // Função para tempo máximo de dias
            function maxDias($conexao, $data_emprestimo, $data_devolucao) 
            {
                $emprestimo = new DateTime($data_emprestimo);
                $devolucao = new DateTime($data_devolucao);

                // Calculo para diferença de dias.
                $diferenca = $devolucao->diff($emprestimo);
                
                // Obtém o número de dias da diferença
                $numDias = $diferenca->days;

                if ($numDias > 10 || $numDias < 0) 
                {
                    return true; // Estourou o limite de dias de empréstimo do livro.
                } 
                else 
                {
                    return false; // Está dentro do limite de dias.
                }
                
            }

            // Função para verificar se a data de devolução do livro é menor que a data de empréstimo
            function verificaDevolucao($conexao, $data_emprestimo, $data_devolucao) 
            {
                $partes_emprestimo = explode("/", $data_emprestimo);

                $dia_emprestimo = $partes_emprestimo[0];
                $mes_emprestimo = $partes_emprestimo[1];
                $ano_emprestimo = $partes_emprestimo[2];

                $partes_devolucao = explode("/", $data_devolucao);

                $dia_devolucao = $partes_devolucao[0];
                $mes_devolucao = $partes_devolucao[1];
                $ano_devolucao = $partes_devolucao[2];

                if ($ano_devolucao < $ano_emprestimo) 
                {

                    return true; // Data de devolução maior que a de empréstimo

                } elseif ($ano_devolucao == $ano_emprestimo && $mes_devolucao < $mes_emprestimo) 
                {

                    return true; // Data de devolução maior que a de empréstimo

                } elseif ($ano_devolucao == $ano_emprestimo && $mes_devolucao == $mes_emprestimo && $dia_devolucao < $dia_emprestimo) 
                {

                    return true; // Data de devolução maior que a de empréstimo

                } 
                else 
                {

                    return false; // Tudo normal, retorna false porque a data de devolução deve ser maior que a de empréstimo

                }
            }

            
            // Função para ver se tem conflito entre intervalo de datas.
            function verificarEmprestimo($conexao, $idexemplar_livro, $data_emprestimo, $data_devolucao)
            {
                $sql = "SELECT data_emprestimo, data_devolucao FROM emprestimo_livro WHERE idexemplar_livro = '{$idexemplar_livro}'";
                $result = mysqli_query($conexao, $sql);
    
                while ($emprestimo = mysqli_fetch_assoc($result)) 
                {
                    $data_inicio = date_create($emprestimo['data_emprestimo']); 
                    $data_fim = date_create($emprestimo['data_devolucao']); 
    
                    $novo_emprestimo_inicio = date_create($data_emprestimo); 
                    $novo_emprestimo_fim = date_create($data_devolucao); 
    
                    // Verificação de datas
                    if (($novo_emprestimo_inicio >= $data_inicio && $novo_emprestimo_inicio <= $data_fim) ||
                        ($novo_emprestimo_fim >= $data_inicio && $novo_emprestimo_fim <= $data_fim)) 
                    {
                        return true; // Conflito de datas encontrado
                    }
                }
    
                return false; // Não há conflito de datas
            }
    
            if ($idexemplar_livro == 0 || $idaluno == 0 || $idlivro == 0) {
                // Exemplar e Aluno não selecionados, exibir uma mensagem de erro ou redirecionar para a página anterior
                ?>
                <script>
                    var msg = "Por favor, selecione todos corretamente.";
                    alert(msg);
                    window.location.href = "emprestimo_html.php";
                </script>
                <?php
                exit;
            }

            if (verificarEmprestimo($conexao, $idexemplar_livro, $data_emprestimo, $data_devolucao)) 
            {
                // O livro está ocupado, exiba a mensagem de erro
                ?>
                <script>
                    // Livro já ocupado, exibir mensagem de erro
                    var msg = "Este Livro já está ocupado nesta data.";
                    alert(msg);
                    window.location.href = "emprestimo_html.php";
                </script>
                <?php
            }     
            else
            {

                if(verificaDevolucao($conexao, $data_emprestimo, $data_devolucao))
                {
                    // Erro a data de devolução é maior que a data de empréstimo
                    ?>
                    <script>
                        // Data de devolução é maior, exibir mensagem de erro
                        var msg = "Data de Devolução menor que Data de Empréstimo.";
                        alert(msg);
                        window.location.href = "emprestimo_html.php";
                    </script>
                    <?php
                    exit;
                }
                elseif(maxDias($conexao, $data_emprestimo, $data_devolucao))
                {
                    // Erro o prazo máximo de dias é de 10 dias
                    ?>
                    <script>
                        // Prazo máximo estourado, exibir mensagem de erro
                        var msg = "O prazo máximo de Empréstimo é de 10 dias.";
                        alert(msg);
                        window.location.href = "emprestimo_html.php";
                    </script>
                    <?php
                    exit;
                }
                else 
                {

                    // Inserir o emprestimo_livro na tabela EMPRESTIMO_LIVRO
                    $sql_emprestimo = "INSERT INTO EMPRESTIMO_LIVRO (idexemplar_livro, idaluno, data_emprestimo, data_devolucao) VALUES('{$idexemplar_livro}', '{$idaluno}', '{$data_emprestimo}', '{$data_devolucao}')";
                    $result_emprestimo = mysqli_query($conexao, $sql_emprestimo);
                    $idemprestimo_livro = mysqli_insert_id($conexao);

                    ?>
                        <script>
                            var msg = "Cadastrado com Sucesso!";
                            alert(msg);
                            window.location.href = "menu.php";
                        </script>
                    <?php 

                }
            }
        }
        elseif(isset($_POST["listar_emprestimo"]))
        {
            header("Location: pesquisa_emprestimo.php");
        }

    }