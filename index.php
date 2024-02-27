<?php

require "cabecalho.php";

?>
    <head>

        <link rel="stylesheet" href="css/style.css">
        <title>LOGIN</title>

    </head>

    <body>

        <div class = "tela-login">
            <form action="login.php" method="POST">
                <h1>Login</h1>
                <br><br>
                <input type = "text" class="nome" name="nome_usuario" placeholder = "Nome" required>
                <br><br>
                <input type = "password" class="senha" name="senha" placeholder = "Senha" required>
                <br><br>
                <input type="submit" class="entrar" name="acessar" value="Acessar">
            </form>
        </div>
        
    </body>

</html>