<?php

$conteudo = file_get_contents("item.json");
$dados = json_decode($conteudo, true);
$tira_item = isset($_GET['item']) ? $_GET['item'] : "Controle";

$escolher_item = array_filter($dados, function ($item) use ($tira_item) {
    return isset($item["item"]) && $item["item"] !== $tira_item;
});

file_put_contents("item.json", json_encode($escolher_item, JSON_PRETTY_PRINT));

echo "o item foi removido do carrinho!";

?>