<?php

include_once ("AccesoDatos.php");
include_once ("usuario.php");

$op = isset($_POST['op']) ? $_POST['op'] : NULL;

switch ($op) {
    case 'accesoDatos':
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios");
        $consulta->execute();
        
        $consulta->setFetchMode(PDO::FETCH_INTO, new usuario);
        
        foreach ($consulta as $usuario) {
        
            print_r($usuario->MostrarDatos());
            print("
                    ");
        }

        break;
 
    case 'mostrarTodos':

        $usuarios = usuario::TraerTodosLosUsuarios();
        
        foreach ($usuarios as $usuario) {
            
            print_r($usuario->MostrarDatos());
            print("
                    ");
        }
    
        break;

    case 'insertarUsuario':
    
        $miUsuario = new usuario();
        //$miUsuario->id = 67;
        $miUsuario->nombre = "Pablo";
        $miUsuario->apellido = "Perez";
        $miUsuario->clave = "clave222";
        $miUsuario->perfil=0;
        $miUsuario->estado=1;
        $miUsuario->correo="correo@hotmail.com";
        
        $miUsuario->InsertarUsuario();

        echo "ok";
        
        break;

    case 'modificarUsuario':
    
        $id = $_POST['id'];        
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $clave = $_POST['clave'];
    
        echo usuario::ModificarUsuario($id, $nombre, $apellido, $clave);
            
        break;

    case 'eliminarCd':
    
        $miCD = new cd();
        $miCD->id = 66;
        
        $miCD->EliminarCD($miCD);

        echo "ok";
        
        break;
        
        
    default:
        echo ":(";
        break;
}
