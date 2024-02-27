<?php 

require "verifica_sessao.php";
require "conexao.php";

if (isset($_POST["acessar"]) && !empty($_POST["nome_usuario"]) && !empty($_POST["senha"])) 
{
    // Acessar sistema
    $nome_usuario = $_POST["nome_usuario"];
    $senha = $_POST["senha"];
    $senha = hash("sha256", $senha);

    // Verifica se o nome que o usuario digitou corresponde ao mesmo do banco de dados
    $sql = "SELECT * FROM usuario WHERE nome_usuario = '{$nome_usuario}' and senha = '{$senha}'";

    // Manda pro banco de dados
    $result = $conexao->query($sql);

    // Verifica o numero de linhas
    if(mysqli_num_rows($result) < 1)
    {
        // Volta para a tela de login se nao existir um usuario valido
        unset($_SESSION["nome_usuario"]);
        unset($_SESSION["senha"]);
        ?>
        <script>
            window.location.href = "index.php";
            alert("Login inválido!");
        </script>
        <?php
    }
    else
    {
        // Acessa o menu do projeto se existir um usuario valido
        $_SESSION["nome_usuario"] = $nome_usuario;
        $_SESSION["senha"] = $senha;

        ?>
        <script>
            window.location.href = "menu.php";
            alert("Usuário Logado");
        </script>
        <?php
        
    }
}
else 
{
    // Não acessa
    header("Location: index.php");
}