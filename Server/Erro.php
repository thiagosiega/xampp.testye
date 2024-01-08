<?php

// Path: Server/Erro.php

// Verificar se o parâmetro "erro" foi definido
$erro = isset($_GET['erro']) ? $_GET['erro'] : null;

// Definir uma mensagem padrão para erros desconhecidos
$message = "Ocorreu um erro desconhecido";

// Tratar erros conhecidos
if ($erro == 1) {
    $message = "Erro ao conectar ao banco de dados";
} else if ($erro == 2) {
    $message = "Servidor não está respondendo";
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro</title>
</head>
<body>
    <h1>Erro</h1>
    <p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
</body>
</html>
