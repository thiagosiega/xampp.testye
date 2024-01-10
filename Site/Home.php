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
    <style>
        body{
        background-image: url("../img/Backgraund2.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        align-items: center;
    }
    .sidebar{
        width: 150px;
        height: 100%;
        background-color: #1C1C1C;
        position: fixed;
    }
    .sidebar-user{
        width: 100%;
        height: 250px;
        background-color: #1C1C1C;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .sidebar-user img{
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-bottom: 10px;
    }
    .sidebar-user h1{
        color: #fff;
        font-size: 20px;
        margin-bottom: 10px;
    }
    .sidebar-user a{
        color: #fff;
        text-decoration: none;
        font-size: 15px;
        margin-bottom: 10px;
    }
    .sidebar-user a:hover{
        color: #fff;
        text-decoration: underline;
    }
    .logo{
        width: 100%;
        height: 50px;
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }
    .logo img{
        width: 40px;
        height: 40px;
    }

    .content {
        width: 100%;
        height: 100%;
        margin-left: 150px;
        display: flex;
        flex-direction: column; /* Set the flex direction to column */
        align-items: center;
        justify-content: center;
    }

    .content h1{
        color: #fff;
        font-size: 30px;
        margin-bottom: 10px;
    }
    .content p{
        color: #fff;
        font-size: 20px;
        margin-bottom: 10px;
    }
    
    .troca_img{
        width: 500px;
        height: auto;
        margin-left: 150px;
        display: flex;
        flex-direction: column; /* Set the flex direction to column */
        align-items: center;
        justify-content: center;
        background-color: rgba(39, 245, 245, 0.41);
        border-radius: 15px;
    }
    .troca_img .Previl{
        width: 200px;
        height: 200px;
        margin-bottom: 10px;
    }
    .troca_img .Previl img{
        width: 200px;
        height: 200px;
        border-radius: 50%;
    }
    .troca_img label{
        color: #fff;
        font-size: 20px;
        margin-bottom: 10px;
    }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-user">
            <div class="logo">
                <img src="../img/baner_fofo.jpg" alt="Logo">
            </div>
            <img src="<?php echo $img; ?>" alt="Foto de perfil">
            <h1><?php echo $Nome; ?></h1>
            <a href="#">Perfil</a>
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
    <div class="troca_img">
        <form action="img_troca/img_user.php" method="POST" enctype="multipart/form-data">
            <div class="Previl">
                <img src="<?php echo $img; ?>" alt="Foto de perfil"><br>
            </div>
            <label for="img">Trocar imagem de perfil</label><br>
            <input type="file" name="img">
            <input type="submit" value="Trocar">
        </form>
    </div>
</body>
</html>