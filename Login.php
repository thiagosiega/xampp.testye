<?php

include_once("Server/Server.php");

$Email = $_POST['email'];
$Senha = $_POST['senha'];

// Verificar se o usuário existe
$verificar = mysqli_prepare($conexao, "SELECT Senha FROM users WHERE email = ?");
mysqli_stmt_bind_param($verificar, "s", $Email);
mysqli_stmt_execute($verificar);
mysqli_stmt_store_result($verificar);

// Se o usuário existir
if (mysqli_stmt_num_rows($verificar) > 0) {
    // Recuperar o hash da senha do banco de dados
    mysqli_stmt_bind_result($verificar, $Senha_hash);
    mysqli_stmt_fetch($verificar);

    // Verificar se a senha está correta
    if (password_verify($Senha, $Senha_hash)) {
        session_start();
        $_SESSION['email'] = $Email;
        header("Location: Site/Home.php");
        exit();
    } else {
        echo "<script>alert('Senha incorreta!');window.location.href='index.html';</script>";
    }
} else {
    echo "<script>alert('Usuário não encontrado!');window.location.href='index.html';</script>";
}

// Fechar a declaração preparada
mysqli_stmt_close($verificar);
?>
