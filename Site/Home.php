<?php
session_start();
if(!isset($_SESSION['email'])){
    $erro = 4;
    header("Location: ../Erros/Codigo_erro.php?$erro");
    exit();
}

include_once("../Server/Server.php");

//verifica as informações do usuário
$verificar = mysqli_prepare($conexao, "SELECT Nome FROM users WHERE email = ?");
mysqli_stmt_bind_param($verificar, "s", $_SESSION['email']);
mysqli_stmt_execute($verificar);
mysqli_stmt_store_result($verificar);

//se o usuário existir
if (mysqli_stmt_num_rows($verificar) > 0) {
    //usando o nome do usuário coleto as informações do mesmo
    mysqli_stmt_bind_result($verificar, $Nome);
    mysqli_stmt_fetch($verificar);
    // coleto as informações do usuário Nome, Email, Senha, Data de nascimento, Sexo, img
    $verificar = mysqli_prepare($conexao, "SELECT Nome, Email, Senha, Data, Sexo, img FROM users WHERE email = ?");
    mysqli_stmt_bind_param($verificar, "s", $_SESSION['email']);
    mysqli_stmt_execute($verificar);
    mysqli_stmt_store_result($verificar);
    mysqli_stmt_bind_result($verificar, $Nome, $Email, $Senha, $Data, $Sexo, $img);
    mysqli_stmt_fetch($verificar);
    //adiciona"../" para acessar a pasta onde está a imagem
    //verifica se o camiho da imagem é padrao
    if($img == "img/Fundo_padrao.jpg"){
        $img = "../".$img;
    }else{
        $img = "img_troca/".$img;
    }

    
} else {
    $erro = 4;
    header("Location: ../Erros/Codigo_erro.php?$erro");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="Style/Home.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-user">
            <div class="logo">
                <img src="../img/baner_fofo.jpg" alt="Logo">
            </div>
            <img src="<?php echo $img; ?>" alt="Foto de perfil">
            <h1><?php echo $Nome; ?></h1>
            <a href="Perfil.php">Perfil</a>
            <a href="#">Configurações</a>
            <a href="../Server/Logout.php">Sair</a>
        </div>
    </div> 
    <div class="content">
        <h1>Olá <?php echo $Nome; ?></h1>
        <p>Data de nascimento: <?php echo $Data; ?></p>
        <p>Sexo: <?php echo $Sexo; ?></p>
        <p>Email: <?php echo $Email; ?></p>
    </div>
</body>
</html>