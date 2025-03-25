<?php

$items = [
    "item": "Videogame",
    "preco": 1000,
    "quantidade": 100
];

$json = json_encode($items, JSON_PRETTY_PRINT);
file_put_contents("item.json", $json)

?>