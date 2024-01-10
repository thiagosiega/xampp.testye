<?php

function redirecionarComErro($erro, $mensagemPadrao) {
    $msg = $mensagemPadrao;

    switch ($erro) {
        case 1:
            $msg = "Server desligado, tente novamente mais tarde.";
            break;
        case 2:
            $msg = "Erro ao conectar ao banco de dados, tente novamente mais tarde.";
            break;
        case 3:
            $msg = "Erro ao cadastrar, tente novamente mais tarde.";
            break;
        case 4:
            $msg = "Opis! Você tentou acessar uma área de login!\nTente novamente mais tarde.";
            break;
    }

    header("Location: Erro.php?$msg");
    exit();
}

echo "<script>alert('Erro!');</script>";
echo $msg;

// Verificar se $erro é nulo ou desconhecido
if ($erro === null || !in_array($erro, [1, 2, 3, 4])) {
    redirecionarComErro($erro, "Erro desconhecido, tente novamente mais tarde.");
}

redirecionarComErro($erro, "Erro desconhecido, tente novamente mais tarde! ok");
?>
