<?php
require_once("clases/Producto.php");

$op=$_POST["op"];


switch ($op) {
    case 'ALTA':
        $nombreP=$_POST["nombreP"];
        $codBarra=$_POST["codBarra"];
        
        $producto=new Producto($codBarra,$nombreP);
        
        if(Producto::Guardar($producto))
        echo "Guardado";
        else
        echo "No se pudo guardar";
        break;
    case 'LEER':
        Producto::Leer();
    break;
    case 'TRAER':
        Producto::TraerTodosLosProductos();
    break;
    default:
        # code...
        break;
}