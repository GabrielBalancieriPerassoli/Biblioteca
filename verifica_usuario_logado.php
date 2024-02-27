<?php 

require_once("verifica_sessao.php");

if (!$_SESSION["usuario_logado"]) 
{
    header("Location: http://localhost/sistema_de_biblioteca/");
}