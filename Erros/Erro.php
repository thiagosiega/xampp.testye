<?php
$msg = isset($_GET['msg']) ? $_GET['msg'] : "Erro desconhecido, tente novamente mais tarde.";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ops! tivemos um probleminha</title>
    <link rel="stylesheet" href="Erro.css">
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>Ops! tivemos um probleminha</h1>
            <p><?php echo $msg; ?></p>
            <a href="../index.html">Voltar</a>
        </div>
    </div>  
</body>
</html>
