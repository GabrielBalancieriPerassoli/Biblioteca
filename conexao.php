<?php 

require_once("verifica_sessao.php");

$hostname = "localhost"; 
$database = "sistema_de_biblioteca";
$user = "root";
$password = "";

$conexao = mysqli_connect($hostname, $user, $password, $database);

if (!$conexao) 
{
    die(mysqli_error($conexao));
}
else 
{
    $_SESSION["conexao"] = $conexao;
}