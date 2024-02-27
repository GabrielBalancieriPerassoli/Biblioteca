<?php 
    require "menu.php";
    require "verifica_sessao.php";

    unset($_SESSION["nome_usuario"]);
    unset($_SESSION["senha"]);
    header("Location: login.php");
?>    