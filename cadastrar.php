<?php

// Path: cadastrar.php

include_once 'Server/Server.php';

if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        if ($conexao) {
            $sql = "SELECT * FROM usuarios WHERE email = '$email'";
            $result = mysqli_query($conexao, $sql);
            $row = mysqli_num_rows($result);
            if ($row > 0) {
                echo "<script>alert('Email já cadastrado!')</script>";
                echo "<script>window.location.href = 'index.php'</script>";
            } else {
                $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
                $result = mysqli_query($conexao, $sql);
                if ($result) {
                    echo "<script>alert('Usuário cadastrado com sucesso!')</script>";
                    echo "<script>window.location.href = 'index.php'</script>";
                } else {
                    $message_error = "Erro ao cadastrar usuário: " . mysqli_error($conexao);
                    header("Location: Server/Erro.php?erro=1");
                    exit(); // Encerrar a execução do script após o redirecionamento
                }
            }
        } else {
            $message_error = "Acesso ao servidor negado: " . mysqli_connect_error();
            header("Location: Server/Erro.php?erro=2");
            exit(); // Encerrar a execução do script após o redirecionamento
        }
    } catch (Exception $e) {
        $message_error = "Erro de conexão com o banco de dados: " . $e->getMessage();
        header("Location: Server/Erro.php?erro=3");
        exit(); // Encerrar a execução do script após o redirecionamento
    } finally {
        mysqli_close($conexao);
    }
}

?>
