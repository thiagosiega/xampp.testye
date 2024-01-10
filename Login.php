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
        echo "Login bem-sucedido!";
    } else {
        echo "Senha incorreta!";
    }
} else {
    echo "Email incorreto!";
}

// Fechar a declaração preparada
mysqli_stmt_close($verificar);
?>
