<?php

include_once ("AccesoDatos.php");
require_once ("usuario.php");

//$recibo=$_POST["param"];
// var_dump($_POST["nombre"]);
// die();

$miUsuario=new usuario();
//$usuarioJSON=json_decode($recibo);

$miUsuario->nombre = $_POST["nombre"];
$miUsuario->apellido = $_POST["apellido"];;
$miUsuario->clave = $_POST["clave"];;
$miUsuario->perfil=$_POST["perfil"];;
$miUsuario->estado=1;
$miUsuario->correo=$_POST["correo"];;
//var_dump($miUsuario);
/* ----------IMAGEN-------------------*/ 
$objRetorno = new stdClass();
$objRetorno->Ok = false;

$destino = "./fotos/" . date("Ymd_His") . ".jpg";
        
if(move_uploaded_file($_FILES["foto"]["tmp_name"], $destino) )
    {
        $objRetorno->Ok = true;
        $objRetorno->Path = $destino;
    }
/**************************************** */
        
if($miUsuario->InsertarUsuario())
{
    echo '{"exito":true,"imagen":'.$objRetorno->Ok.',
            "nombre":"'.$miUsuario->nombre.'","pathFoto":"'.$objRetorno->Path.'"}';
}
else
{
    echo '{"exito":false,"imagen":'.$objRetorno->Ok.'}';
}

