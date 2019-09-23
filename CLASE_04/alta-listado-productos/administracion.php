<?php
require_once ("clases/producto.php");
require_once ("clases/archivo.php");

//Recibir nombre y clave de usuario, para guardar en clave de sesion

$alta = isset($_POST["guardar"]) ? TRUE : FALSE;
$destino="./img";

if($alta) {


	$p = new Producto($_POST["codBarra"],$_POST["nombre"],$_FILES["archivo"]["name"]);
	
	if(!Producto::Guardar($p)){
		$mensaje = "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
		include("mensaje.php");
	}
	else{
		$mensaje = "El archivo fue escrito correctamente. PRODUCTO agregado CORRECTAMENTE!!!";
		if(!Archivo::Subir())
	{
		$p->SetPathFoto("pordefecto.jpg");
		$mensaje.="La imagen asociada no se pudo subir";
	}
	else{
		$mensaje.="La imagen se subio correctamente";
	}
		
		
		include("mensaje.php");
	}
	
}//if $alta
?>