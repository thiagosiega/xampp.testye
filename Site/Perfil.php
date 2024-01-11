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
    <title>Perfil: <?php echo $Nome; ?></title>
    <link rel="stylesheet" href="Style/Perfil.css">
</head>
<body>
    <div class="infor_perfil">
        <div class="img_perfil">
            <img src="<?php echo $img; ?>" alt="Imagem de perfil">
        </div>
        <div class="infor_site">
            <h1>Email: </h1>
            <h2>Nome: </h2>
            <h2>Data de nacimento: </h2>
            <h2>Sexo: </h2>
        </div>
        <div class="infor_user">
            <h1><?php echo $Nome; ?></h1>
            <h2><?php echo $Email; ?></h2>
            <h2><?php echo $Data; ?></h2>
            <h2><?php echo $Sexo; ?></h2>
        </div>
    </div>
    <div class="troca_img">
        <form action="img_troca/img_user.php" method="POST" enctype="multipart/form-data">
            <label for="img">Trocar imagem de perfil</label><br>
            <input type="file" name="img">
            <input type="submit" value="Trocar">
        </form>
    </div> 
    <div class="basse_atalho">
        <a href="Home.php">Home</a>
        <a href="../Server/Logout.php">Sair</a>
        <a href="#">Carrinho</a>
    </div>   
</body>
</html>