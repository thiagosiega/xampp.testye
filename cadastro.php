<?php

include_once("Server/Server.php");

$Nome = $_POST['nome'];
$Sobrenome = $_POST['sobrenome'];
$Email = $_POST['email'];
$Senha = $_POST['senha'];
$Senha = md5($Senha);
$Sexo = $_POST['sexo'];
$Data = $_POST['data'];

//verificar se o email já existe
$verificar = mysqli_query($conexao, "SELECT * FROM users WHERE email = '$Email'");
if(mysqli_num_rows($verificar) > 0){
    echo "<script>alert('Email já cadastrado!');window.location.href='index.html';</script>";
}else{
    $sql = "INSERT INTO users (Nome, Sobrenome, Email, Senha, Sexo, Data) VALUES ('$Nome', '$Sobrenome', '$Email', '$Senha', '$Sexo', '$Data')";
    $resultado = mysqli_query($conexao, $sql);
    if($resultado){
        header("Location: index.html");
        exit();
    }else{
        $erro =3;
        header("Location: Erros/Codigo_erro.php?$erro");
        exit();
    }
}
exit();
?>