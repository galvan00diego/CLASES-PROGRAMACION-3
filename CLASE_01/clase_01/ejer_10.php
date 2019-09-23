<?php

/*Aplicación Nº 10 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for ) cada uno en una línea distinta (recordar que el
salto de línea en HTML es la etiqueta <br/> ). Repetir la impresión de los números utilizando
las estructuras while y foreach*/

$array=array(1);

for ($i=0; $i < 9; $i++) { 
    array_push($array,$array[$i]+2);
}
//var_dump($array);
echo "Estructura FOR:<br>";
for ($i=0; $i <count($array) ; $i++) { 
    echo $array[$i]."<br>";
}
echo "Estructura WHILE:<br>";
$a=0;
while ($a < count($array)) {
    echo $array[$a]."<br>";
    $a++;
}
echo "Estructura FOREACH:<br>";
foreach ($array as $value) {
    echo $value."<br>";
}