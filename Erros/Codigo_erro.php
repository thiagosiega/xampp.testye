<?php
if ($erro == null) {
    $msg = "Erro desconhecido, tente novamente mais tarde.";
    header("Location: Erros/Erro.php?$msg");
}
if ($erro == 1) {
    //server deligado/sem conexao
    $msg = "Server desligado tente novamente mais tarde.";
    header("Location: Erros/Erro.php?$msg");
}
if ($erro == 2) {
    //erro ao conectar ao banco de dados
    $msg = "Erro ao conectar ao banco de dados, tente novamente mais tarde.";
    header("Location: Erros/Erro.php?$msg");
}
if ($erro == 3) {
    //erro ao cadastrar
    $msg = "Erro ao cadastrar, tente novamente mais tarde.";
    header("Location: Erros/Erro.php?$msg");
}
else {
    $msg = "Erro desconhecido, tente novamente mais tarde.";
    header("Location: Erros/Erro.php?$msg");
}

?>