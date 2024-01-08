<?php

include_once 'Server/Server.php';

if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    try{
        //verificaçao se o email ja existe
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $resultado = mysqli_query($conexao, $sql);
        if ($resultado->num_rows > 0) {
            echo "<script>alert('Email já cadastrado!');</script>";
        }
        else{
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
            
        }
        

    } catch (PDOException $e) {
        $erro = 1;
        header("Location: Erro.php?erro=$erro");
    }

} else {
    $erro = 4;
    header("Location: Erro.php?erro=$erro");
}
?>
