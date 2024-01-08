<?php
$nome_server = "localhost";
$senha_server = "";
$usuario_server = "root";
$banco_server = "Usuarios";

try {
    $conexao = mysqli_connect($nome_server, $usuario_server, $senha_server, $banco_server);
} catch (Exception $e) {
    $erro = 1;
    header("Location: Server/Codigos_erro.php?erro=$erro");
    exit(); // Encerrar a execução do script após o redirecionamento
} finally {
    mysqli_close($conexao);
}

?>
