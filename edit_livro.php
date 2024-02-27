<?php

    require "conexao.php";
    require "cabecalho.php";

    $nome_livro = '';
    $ano_publicacao = '';

    if (!empty($_GET['idlivro'])) {

        $id = $_GET['idlivro'];

        $sql_select = "SELECT * FROM livro WHERE idlivro = $id";
        
        $result = $conexao->query($sql_select);

        if ($result->num_rows > 0) {

            $user_data = mysqli_fetch_assoc($result);
            $nome_livro = $user_data['nome_livro'];
            $ano_publicacao = $user_data['ano_publicacao'];

        } else {
            header("Location: cadastro_livro.php");
            exit;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <link rel="stylesheet" href="css/style.css">
        <title>EDITAR LIVRO</title>

    </head>

    <body class="corpo">
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="menu.php">Home <span class="sr-only">(current)</span></a>
                    </div>
                </div>
                <div>
                    <a href="sair.php" class="btn btn-danger">Sair</a>
                </div>
        </nav>
    </body>

    <body>
        <div class="container">
            <div class="tela-cadastro">
                <form action="edit_livro.php" method="POST">
                    <h2>Editar Livro</h2>
                    <br><br>
                    <h4>Nome Livro</h4>
                    <input type="hidden" name="idlivro" value="<?php echo $id; ?>">
                    <input type="text" class="livro" name="nome_livro" placeholder="Nome Livro" value="<?php echo $nome_livro; ?>" required>
                    <br><br>
                    <h4>Ano</h4>
                    <input type="text" class="livro" name="ano_publicacao" placeholder="Ano" value="<?php echo $ano_publicacao; ?>" required>
                    <br><br>
                    <input type="submit" class="cadastrar" name="update_livro" id="updade" value="Editar Dados">
                </form>
            </div>
        </div>
    </body>
    
</html>

<?php

    if (!empty($_POST['update_livro'])) {

        // Processar o formulário e atualizar o valor do banco de dados
        $conexao = $_SESSION["conexao"];
        $id = $_POST['idlivro'];
        $nome_livro = $_POST['nome_livro'];
        $ano_publicacao = $_POST['ano_publicacao'];
    
        // Update nos campos da tabela      
        $sql_update = "UPDATE LIVRO SET nome_livro = '{$nome_livro}', ano_publicacao = ('{$ano_publicacao}') WHERE idlivro = ('{$id}')";      
        $result_update = mysqli_query($conexao, $sql_update);

        if ($result_update) 
        {
            ?>
            <script>
                var msg = "Editado com Sucesso!";
                alert(msg);
                window.location.href = "menu.php";
            </script>
            <?php
        } else 
        {
            echo "Erro ao atualizar o livro: " . mysqli_error($conexao);
        }
    }

?>