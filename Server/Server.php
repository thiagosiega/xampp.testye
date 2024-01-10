<?php

$nome = "localhost";
$usuario = "root";
$banco = "usuarios";
$senha = "";

$conexao = mysqli_connect($nome, $usuario, $senha, $banco);
if (!$conexao) {
    $erro = 1;
    header("Location: Erros/Erro.php?erro=$erro");
}


?>