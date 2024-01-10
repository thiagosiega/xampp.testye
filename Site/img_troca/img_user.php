<?php

session_start();
if (!isset($_SESSION['email'])) {
    $erro = 4;
    header("Location: ../Erros/Codigo_erro.php?$erro");
    exit();
}

//recebe a imagem
$img = $_FILES['img'];

//verifica se a imagem foi enviada
if (!empty($img['name'])) {
    //verifica se a imagem é do tipo jpg ou png
    if (preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $img["type"])) {
        //verifica se o tamanho da imagem é menor que 5MB
        $formatoArray = explode(".", $img["name"]);
        $formato = end($formatoArray);
        $tamanho = round($img["size"] / 1024);
        if ($tamanho < 5000) {
            // cria um nome para a imagem com 15 caracteres aleatórios
            $nome_imagem = md5(uniqid(time())) . "." . $formato;
            // local onde a imagem será salva
            $local = "user_img/" . $nome_imagem;
            // move a imagem para o local
            move_uploaded_file($img["tmp_name"], $local);

            // remove o "../" da variável $local
            $local_sem_pontos = preg_replace('/\.\.\//', '', $local);

            // conecta ao banco de dados
            include_once("../../Server/Server.php");

            // atualiza a imagem do usuário
            $atualizar = mysqli_prepare($conexao, "UPDATE users SET img = ? WHERE email = ?");
            mysqli_stmt_bind_param($atualizar, "ss", $local_sem_pontos, $_SESSION['email']);
            mysqli_stmt_execute($atualizar);

            // fecha a conexão
            mysqli_close($conexao);

            // redireciona para a página Home.php
            header("Location: ../Home.php");
            exit();
        } else {
            $erro = 5;
            header("Location: ../Erros/Codigo_erro.php?$erro");
            exit();
        }
    } else {
        $erro = 6;
        header("Location: ../Erros/Codigo_erro.php?$erro");
        exit();
    }
} else {
    $erro = 7;
    header("Location: ../Erros/Codigo_erro.php?$erro");
    exit();
}

?>