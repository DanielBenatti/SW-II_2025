<?php
    $vetor = ['Daniel', 'Bryan', 'Vitor', 'Lucas'];
    $num = count($vetor);

    #echo $vetor;                 buga tudo
    #var_dump($vetor);            mostra todos os itens
    #echo $vetor[1];              mostra apenas o item na posição exata

    //echo $num;

    for ($i=0; $i < $num ; $i++) { 
        echo $vetor[$i];
        echo "<br>";
    }

    /*
    foreach ($vetor as $homis) {
        echo 'Os machos: '.$homis."<br>";
    }
    */

?>