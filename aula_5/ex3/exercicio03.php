<?php

$conteudo = file_get_contents("item.json");
$dados = json_decode($conteudo, true);

$add_item = [
    "item": "Controle",
    "preco": 500,
    "quantidade": 200
];

$dados[] = $add_item;

file_put_contents("item.json", json_encode($dados, JSON_PRETTY_PRINT));

echo "Item adicionado ao carrinho!";

?>