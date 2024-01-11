<?php
$lista = array();

for ($i = 0; $i < $quant_produtos; $i++) {
    $produto = rand(1, 2); // Ou qualquer lógica para definir o produto
    $item = array();

    if ($produto == 1) {
        $item['nome'] = "Cadeira";
        $item['descricao'] = "Cadeira de escritório";
        $item['valor'] = "R$ 200,00";
        $item['imagem'] = "../img/Backgraund1.jpg";
    } elseif ($produto == 2) {
        $item['nome'] = "Mesa";
        $item['descricao'] = "Mesa de escritório";
        $item['valor'] = "R$ 300,00";
        $item['imagem'] = "../img/Backgraund2.jpg";
    } else {
        $item['nome'] = "Opis: Tivemos um erro";
        $item['descricao'] = "Opis: Tivemos um erro";
        $item['valor'] = "R$ 0,0";
        $item['imagem'] = "img/Fundo_padrao.jpg";
    }

    $lista[] = $item;
}
?>
