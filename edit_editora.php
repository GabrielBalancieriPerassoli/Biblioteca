<?php

    require "conexao.php";
    require "cabecalho.php";

    $nome_editora = '';

    if (!empty($_GET['ideditora'])) {

        $id = $_GET['ideditora'];

        $sql_select = "SELECT * FROM editora WHERE ideditora = $id";
        
        $result = $conexao->query($sql_select);

        if ($result->num_rows > 0) 
        {

            $user_data = mysqli_fetch_assoc($result);
            $nome_editora = $user_data['nome_editora'];

        } else {
            header("Location: cadastro_editora.php");
            exit;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <link rel="stylesheet" href="css/style.css">
        <title>EDITAR EDITORA</title>

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
                <form action="edit_editora.php" method="POST">
                    <h2>Editar Editora</h2>
                    <br><br>
                    <h4>Nome Editora</h4>
                    <input type="hidden" name="ideditora" value="<?php echo $id; ?>">
                    <input type="text" class="editora" name="nome_editora" placeholder="Nome Editora" value="<?php echo $nome_editora; ?>" required>
                    <br><br>
                    <input type="submit" class="cadastrar" name="update_editora" id="updade" value="Editar Dados">
                </form>
            </div>
        </div>
    </body>
    
</html>

<?php

    if (!empty($_POST['update_editora'])) {

        // Processar o formulário e atualizar o valor do banco de dados
        $conexao = $_SESSION["conexao"];
        $id = $_POST['ideditora'];
        $nome_editora = $_POST['nome_editora'];
    
        // Update nos campos da tabela      
        $sql_update = "UPDATE EDITORA SET nome_editora = ('{$nome_editora}') WHERE ideditora= ('{$id}')";      
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
            echo "Erro ao atualizar a editora: " . mysqli_error($conexao);
        }
    }

?>