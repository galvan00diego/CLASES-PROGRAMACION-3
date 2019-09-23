<?php

/*Aplicación Nº 9 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand ). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado.*/

$array=array();
$promedio=0;
for ($i=0; $i < 5; $i++) { 
  array_push($array,rand(0,10));
}
for ($i=0; $i <count($array) ; $i++) { 
    $promedio+=$array[$i];
}
$promedio=$promedio/count($array);

echo "Los numeros del array son: ";
    foreach ($array as $value) {
        echo $value.", ";
    }
if($promedio<6)
{
    
    echo "el promedio es ".$promedio.", es menor a 6";
}
else
{
    echo "el promedio es ".$promedio.", es mayor a 6";
}




