<?php

include_once 'Server/Server.php';

$Email = $_POST['Email'];
$Senha = $_POST['Senha'];
$Senha = hash('sha512', $Senha);

if ($conexao) {
    $sql = "SELECT * FROM `users` WHERE `Email` = '$Email' AND `Senha` = '$Senha'";
    $resultado = mysqli_query($conexao, $sql);
    if (mysqli_num_rows($resultado) > 0){
        echo "Logado com sucesso!";        
    }else{
        echo "<script>alert('Email ou senha incorretos!');window.location.href='index.html';</script>";
    }
    
}else{
    $erro = 2;
    header("Location: Erros/Codigo_erro.php?erro=$erro");
    exit();
}


?>