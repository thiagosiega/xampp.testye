<?php

// Path: Server/Erro.php

$messagem = isset($_GET['erro']) ? $_GET['erro'] : 'Erro desconhecido';

//verifica se messagem é um texto
if (is_string($messagem)) {
    $message = $messagem;
} else {
    $message = 'Erro desconhecido,Contacte o administrador do sistema';
}

$titulo = 'Erro';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <div class="box">
        <h1><?php echo $titulo; ?></h1>
        <p><?php echo $message; ?></p>
        <a href="index.php">Voltar</a>
    </div>
</body>
</html>
