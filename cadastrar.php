<?php

include_once 'Server/Server.php';

if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    

    try {
        // Verifica se a conexão com o banco de dados foi estabelecida corretamente
        if (!$conexao) {
            throw new Exception("Acesso ao servidor negado: " . mysqli_connect_error());
        }

        // Evita SQL Injection usando instruções preparadas
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            echo "<script>alert('Email já cadastrado!')</script>";
            echo "<script>window.location.href = 'index.php'</script>";
        } else {
            // Inserção segura usando instruções preparadas
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conexao, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $senha);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                echo "<script>alert('Usuário cadastrado com sucesso!')</script>";
                echo "<script>window.location.href = 'index.php'</script>";
            } else {
                $erro = 4;
                header("Location: Server/Codigo_erro.php?erro=$erro");
                exit();
            }
        }
    } catch (Exception $e) {
        $erro = 4;
        header("Location: Server/Codigo_erro.php?erro=$erro");
        exit();
    } finally {
        mysqli_close($conexao);
    }
}
?>
