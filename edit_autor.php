<?php

    require "conexao.php";
    require "cabecalho.php";

    $nome_autor = '';

    if (!empty($_GET['idautor'])) {

        $id = $_GET['idautor'];

        $sql_select = "SELECT * FROM autor WHERE idautor = $id";
        
        $result = $conexao->query($sql_select);

        if ($result->num_rows > 0) 
        {

            $user_data = mysqli_fetch_assoc($result);
            $nome_autor = $user_data['nome_autor'];

        } else {
            header("Location: cadastro_autor.php");
            exit;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <link rel="stylesheet" href="css/style.css">
        <title>EDITAR AUTOR</title>

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
                <form action="edit_autor.php" method="POST">
                    <h2>Editar Autor</h2>
                    <br><br>
                    <h4>Nome Autor</h4>
                    <input type="hidden" name="idautor" value="<?php echo $id; ?>">
                    <input type="text" class="autor" name="nome_autor" placeholder="Nome Autor" value="<?php echo $nome_autor; ?>" required>
                    <br><br>
                    <input type="submit" class="cadastrar" name="update_autor" id="updade" value="Editar Dados">
                </form>
            </div>
        </div>
    </body>
    
</html>

<?php

    if (!empty($_POST['update_autor'])) {

        // Processar o formulário e atualizar o valor do banco de dados
        $conexao = $_SESSION["conexao"];
        $id = $_POST['idautor'];
        $nome_autor = $_POST['nome_autor'];
     
        // Update nos campos da tabela
        $sql_update = "UPDATE AUTOR SET nome_autor = ('{$nome_autor}') WHERE idautor= ('{$id}')";      
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
            echo "Erro ao atualizar o autor: " . mysqli_error($conexao);
        }
    }

?>