<?php

//var_dump($_REQUEST);

$nombre=$_REQUEST["txtNombre"];
$apellido=$_REQUEST["txtApellido"];


$path_archivo="Saludo.txt";
$archivo=fopen($path_archivo,"a+");
$cant=fwrite($archivo,"Hola Mundo!\n\r");
fwrite($archivo,$nombre."\n\r");
fwrite($archivo,$apellido."\n\r");
if($cant>0)
{
    echo "Guardado<br>";
}

fclose($archivo);
