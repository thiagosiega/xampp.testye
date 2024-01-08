<?php

$erro = isset($_GET['erro']) ? $_GET['erro'] : 'Erro desconhecido';

//verifica se o erro é um número
if (is_numeric($erro)){
    if ($erro == 1){
        $messagem = "Erro de conexão com o banco de dados";
    }
    elseif ($erro == 2){
        $messagem = "Erro na Pesquisa na servidor";
    }
    elseif ($erro == 3){
        $messagem = "Erro: resposta inesperada do servidor";
    }
    elseif ($erro == 4){
        $messagem = "Erro ao receber dados do formulário";
    }
    else{
        $messagem = "Erro desconhecido,Contacte o administrador do sistema";
    }
    header("Location: Erro.php?erro=$messagem");
}
else{
    header("Location: Erro.php?erro=Erro desconhecido");
}

?>