<?php
$nome_server = "localhost";
$senha_server = "";
$usuario_server = "root";
$banco_server = "suarios";

try {
    $conexao = mysqli_connect($nome_server, $usuario_server, $senha_server, $banco_server);
} catch (Exception $e) {
    $message_error = "Erro de conexão com o banco de dados: " . $e->getMessage();
    header("Location: Server/Erro.php?erro=3");
    exit(); // Encerrar a execução do script após o redirecionamento
} finally {
    mysqli_close($conexao);
}

?>
