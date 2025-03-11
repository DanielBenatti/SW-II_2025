<?php
    $num = [2,3,4,5,6,7,8,9,10,11,12,13,14,15,16];

    for ($i=0; $i < count($num); $i++) { 
        if ($val[$i] %2 == 1) {
            $impar[] = $val[$i];
        }else{
            $par[] = $val[$i];
        }
    }

?>