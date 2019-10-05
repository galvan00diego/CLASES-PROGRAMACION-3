<?php
include_once ("AccesoDatos.php");
require_once ("usuario.php");
$recibo=$_POST["param"];

$Miusuario=new usuario();
$usuarioJSON=json_decode($recibo);

$correo=$usuarioJSON->correo;
$clave=$usuarioJSON->clave;
$user=$Miusuario->existeUsuario($correo,$clave);
       //var_dump($existe);
        if($user->existe==TRUE)
        {
            session_start();
            $_SESSION["perfil"]=$user->datos->perfil;
            echo json_encode($user);
        }
        else
        {
            echo json_encode($user);
        }
        
 

        
        



