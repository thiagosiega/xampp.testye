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


$quant_produtos = 5;
include_once("itens/gerente_itens.php");

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
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .siderbar {
            width: 300px;
            height: 98%;
            background-color: rgba(114, 58, 179, 0.59);
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
        .conteudo {
            width: 100%;
            height: 98%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: rgba(216, 55, 83, 0.41);
            font-size: 30px;
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
        }

        .carrossel {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: row; /* Alteração para distribuir os itens horizontalmente */
        }

        .item {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .item > img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="siderbar">
        <div class="img">
            <img src="<?php echo $img; ?>" alt="Foto de perfil"><br>
        </div>
        <h1><?php echo $Nome; ?></h1>
        <div class="atalhos">
            <a href="Home.php">Home</a>
            <a href="Perfil.php">Perfil</a>
            <a href="Carrinho.php" name="sair">Carrinho</a>
            <a href="../Server/Logout.php">Sair</a>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var sidebar = document.querySelector(".siderbar");

            // Inicia ocultando o sidebar
            sidebar.style.left = "-300px"; // Move a sidebar para fora da tela

            function sair() {
                var sair = confirm("Deseja realmente sair?");
                if (sair == true) {
                    window.location.href = "../Server/Logout.php";
                }
            }

            function esconder(event) {
                var sidebarWidth = sidebar.offsetWidth;

                if (event.clientX < 20) {
                    sidebar.style.left = "0";
                } else if (event.clientX > sidebarWidth + 20) {
                    sidebar.style.left = "-300px";
                }
            }

            document.addEventListener('mousemove', esconder);
        });
    </script>
    <div class="conteudo">
        <div class="carrossel">
            <?php foreach ($lista as $item) { ?>
                <div class="item">
                    <img src="<?php echo $item['imagem']; ?>" alt="Foto do produto">
                    <h1><?php echo $item['nome']; ?></h1>
                    <p><?php echo $item['descricao']; ?></p>
                    <p><?php echo $item['valor']; ?></p>
                </div>
            <?php } ?>
        </div>
</body>
</html>