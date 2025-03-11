<?php
    //a)
    $pessoa = ["nome" => "Bryan", "idade" => "16", "cidade" => "Ribeirão Pires"];

    //b)
    $pessoa["profissao"] = "vagabundo";

    //c)
    $amigos = ["Vitor", "Daniel", "Lucas"];

    //d)
    $dados = array_merge($pessoa, $amigos);

    //e)
    print_r($dados);
?>