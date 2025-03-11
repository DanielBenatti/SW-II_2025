<?php
    $val = [32,534,8,877,17,62,4,26];
    $max = -1000000000;
    $min = 1000000000;

    for ($i=0; $i < count($val); $i++) { 
        if ($max < $val[$i]) {
            $mas = $val[$i];
        }
    }

    for ($i=0; $i < count($val); $i++) { 
        if ($min > $val[$i]) {
            $min = $val[$i];
        }
    }

    echo "o menor valor é: ".$min."<br>";
    echo "o maior valor é: ".$max;
?>