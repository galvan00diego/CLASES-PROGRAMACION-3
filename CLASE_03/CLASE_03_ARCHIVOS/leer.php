<?php
$path_archivo="Saludo.txt";
$archivo=fopen($path_archivo,"r");

while(!feof($archivo))
{
    echo fgets($archivo)."<br><hr>";
}

//echo fgets($archivo,filesize($path_archivo));
//echo fgets($archivo);
fclose($archivo);