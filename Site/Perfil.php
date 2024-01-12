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
    <style>
        body{
            transition: margin-left 0.5s ease-in-out; /* Adiciona uma transição suave para o corpo */
            background-image: url("../img/Backgraund2.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin-left: 0;
        }
        .siderbar {
            width: 300px;
            height: 98%;
            background-color: rgba(139, 60, 240, 1);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 20px 0;
            transition: left 0.5s ease-in-out;

            >h1 {
                font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                font-size: 30px;
                color: #fff;
                margin-bottom: 20px;

            }

            >.img {
                width: 150px;
                height: 150px;
                border-radius: 50%;
                overflow: hidden;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 20px;

                >img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
            }
            > .atalhos {
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                > a {
                    width: 100%;
                    padding: 10px 0;
                    text-align: center;
                    color: #fff;
                    font-size: 20px;
                    text-decoration: none;
                    border-bottom: 1px solid #fff;
                    transition: 0.3s;
                    &:hover {
                        background-color: rgba(255, 0, 0, 0.2); /* Red hover color */
                    }
                    
                }
            }
            
        }     
        .Esquerdo{
            width: 200px;
            height: 100%;
            position: fixed;
            margin-left: -10px;
            margin-top: -10px;
            background-color: rgba(114, 58, 179, 0.59);
            display: flex;
            flex-direction: column;
            align-items: center;
            > h1 {
                font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                font-size: 15px;
                color: #fff;
            }
        } 
        .Direito{
            width: 100%;
            height: 100%;
            position: fixed;
            margin-left: 200px;
            margin-top: -10px;
            display: flex;
            flex-direction: column;
            align-items: laft;
            > h1 {
                font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                font-size: 15px;
                color: #fff;
            }
            > .img_perfil{
                width: 100%;
                height: 100%;
                position: fixed;
                margin-left: 200px;
                margin-top: -10px;
                display: flex;
                flex-direction: column;
                align-items: laft;
                > h1 {
                    font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                    font-size: 15px;
                    color: #fff;
                }
                
            }
        } 
        .conteudo {
            width: 100%;
            height: 100%;
            position: fixed;
            margin-left: 300px;
            margin-top: -10px;
            display: flex;
            flex-direction: column;
            align-items: laft;
            > h1 {
                font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                font-size: 15px;
                color: #fff;
            }
        }                
    </style>
</head>
<body>
    <div class="siderbar">
        <h1>Perfil</h1>
        <div class="img">
            <img src="<?php echo $img; ?>" alt="Foto de perfil">
        </div>
        <div class="atalhos">
            <h1><?php echo $Nome; ?></h1>
            <a href="Home.php">Home</a>
            <a href="#">Carrinho</a>
            <a href="../Server/Logout.php">Sair</a>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var sidebar = document.querySelector(".siderbar");
            var body = document.body;
            var conteudo = document.querySelector(".conteudo");

            // Inicia ocultando o sidebar
            sidebar.style.transition = "left 0.3s ease-in-out"; // Adiciona uma transição suave
            conteudo.style.transition = "margin-left 0.5s ease-in-out"; // Adiciona uma transição suave

            // Move a sidebar para fora da tela
            sidebar.style.left = "-300px";
            
            function esconder(event) {
                var sidebarWidth = sidebar.offsetWidth;

                if (event.clientX < 20) {
                    sidebar.style.left = "0";
                    body.style.marginLeft = (sidebarWidth * 1) + "px";
                    conteudo.style.marginLeft = (sidebarWidth * 0.8) - "px";
                } else if (event.clientX > sidebarWidth + 20) {
                    sidebar.style.left = "-300px";
                    body.style.marginLeft = "0";
                    conteudo.style.marginLeft = "0";
                }
            }

            document.addEventListener('mousemove', esconder);
        });
    </script>
    <div class="conteudo">
        <div class="Esquerdo">
            <h1>Nome: </h1>
            <h1>Email: </h1>
            <h1>Sexo: </h1>
            <h1>Data de nascimento: </h1>
        </div>
        <div class="Direito">
            <h1><?php echo $Nome; ?></h1>
            <h1><?php echo $Email; ?></h1>
            <h1><?php echo $Sexo; ?></h1>
            <h1><?php echo $Data; ?></h1><br>
            <div class = "img_perfil">
                <form action="img_troca/img_user.php" method="POST" enctype="multipart/form-data">
                    <label for="img">Escolha uma imagem de perfil:</label><br>
                    <input type="file" name="img" id="img" accept="image/*"><br>
                    <input type="submit" value="Enviar">
                </form>
            </div>
        </div>    
    </div>      
</body>
</html>