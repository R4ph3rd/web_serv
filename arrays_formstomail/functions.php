<?php

function itemsnb($i){
    $result = ($i * 5 + 20 ) / 1.5 ;
    return $result;
}

function datefr ($d){
$dater = explode ('-', $d, 3);
return $dater[2].'-'.$dater[1].'-'.$dater[0];
}
?>

PHPDATE▸echo date(‘Y-m-d’); ▸d : Jour du mois, sur deux chiffres (éventuellement avec un zéros) : "01" à "31"
D : Jour de la semaine, en trois lettres (et en anglais) : par exemple "Fri" (pour Vendredi)
F : Mois, textuel, version longue; en anglais, i.e. "January" (pour Janvier)
h : Heure, au format 12h, "01" à "12"
H : heure, au format 24h, "00" à "23"g : Heure, au format 12h sans les zéros initiaux, "1" à "12"
G : Heure, au format 24h sans les zéros initiaux, "0" à "23"
i : Minutes; "00" à "59"j : Jour du mois sans les zéros initiaux: "1" à "31"
l : Jour de la semaine, textuel, version longue; en anglais, i.e. "Friday" (pour Vendredi
L : Booléen pour savoir si l'année est bissextile ("1") ou pas ("0")
m : Mois; i.e. "01" à "12"
n : Mois sans les zéros initiaux; i.e. "1" à "12"
M : Mois, en trois lettres (et en anglais
 : par exemple "Jan" (pour Janvier)
s : Secondes; i.e. "00" à "59"