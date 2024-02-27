<?php

    require "conexao.php";
    require "cabecalho.php";

    $nome_aluno = '';
    $cpf = '';
    $ra = '';

    if (!empty($_GET['idaluno'])) {

        $id = $_GET['idaluno'];

        $sql_select = "SELECT * FROM aluno WHERE idaluno = $id";
        
        $result = $conexao->query($sql_select);

        if ($result->num_rows > 0) 
        {

            $user_data = mysqli_fetch_assoc($result);
            $nome_aluno = $user_data['nome_aluno'];
            $cpf = $user_data['cpf'];
            $ra = $user_data['ra'];

        } else {
            header("Location: cadastro_aluno.php");
            exit;
        }
    }

?>


<!DOCTYPE html>
<html lang="en">

    <head>

        <link rel="stylesheet" href="css/style.css">
        <title>EDITAR ALUNO</title>

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
                <form action="edit_aluno.php" method="POST">
                    <h2>Editar Aluno</h2>
                    <br><br>
                    <h4>Aluno</h4>
                    <input type="hidden" name="idaluno" value="<?php echo $id; ?>">
                    <input type="text" class="aluno" name="nome_aluno" placeholder="Nome Aluno" value="<?php echo $nome_aluno; ?>" required>
                    <input type="text" class="aluno" name="cpf" placeholder="Cpf" value="<?php echo $cpf; ?>" required>
                    <input type="text" class="aluno" name="ra" placeholder="Ra" value="<?php echo $ra; ?>" required>
                    <br><br>
                    <input type="submit" class="cadastrar" name="update_aluno" id="updade" value="Editar Dados">
                </form>
            </div>
        </div>
    </body>
    
</html>

<?php

    if (!empty($_POST['update_aluno'])) {

        // Processar o formulário e atualizar o valor do banco de dados
        $conexao = $_SESSION["conexao"];
        $id = $_POST['idaluno'];
        $nome_aluno = $_POST['nome_aluno'];
        $cpf = $_POST['cpf'];
        $ra = $_POST['ra'];
        
        // Update nos campos da tabela
        $sql_update = "UPDATE ALUNO SET nome_aluno = '{$nome_aluno}', cpf = '{$cpf}', ra = '{$ra}' WHERE idaluno = ('{$id}')";      
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
            echo "Erro ao atualizar o aluno: " . mysqli_error($conexao);
        }
    }

?>