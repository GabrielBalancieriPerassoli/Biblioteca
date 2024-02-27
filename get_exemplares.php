<?php

    require "cabecalho.php";
    require "verifica_sessao.php";
    require "conexao.php";

    if (isset($_GET['livro_id'])) {
        $livroId = $_GET['livro_id'];
        
        $mysqli = new mysqli('localhost', 'root', '', 'sistema_de_biblioteca');
        $query = $mysqli->query("SELECT * FROM exemplar_livro WHERE idlivro = $livroId");
    
        if ($query) {
            if (mysqli_num_rows($query) > 0) {
                while ($exemplar = mysqli_fetch_array($query)) {
                    echo '<option value="'.$exemplar['idexemplar_livro'].'">'.$exemplar['numero_exemplar'].'</option>';
                }
            } else {
                echo '<option value="0">Erro</option>';
            }
        } else {
            echo '<option value="0">Erro</option>';
        }
    } else {
        echo '<option value="0">ID do livro não fornecido</option>';
    }

?>