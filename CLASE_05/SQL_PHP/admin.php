<?php

$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;
$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : NULL;
$apellido = isset($_POST["apellido"]);
$clave = isset($_POST["clave"]);
$perfil = isset($_POST["perfil"]);
$estado = isset($_POST["estado"]);
$codigo_barra=isset($_POST["codigo_barra"]) ? $_POST["codigo_barra"] : NULL;
$path_foto=isset($_POST["path_foto"]) ? $_POST["path_foto"] : NULL;
$id = isset($_POST["id"]) ? $_POST["id"] : NULL;

$host = "localhost";
$user = "root";
$pass = "";
$base = "mercado";

$con = @mysqli_connect($host, $user, $pass,$base);

switch ($queHago) {
    case 'TraerTodos_Usuarios':
        echo "Traigo todos los usuarios\n";

        $sql = "SELECT * FROM usuarios";
        $rs = $con->query($sql);
        
        while ($row = $rs->fetch_object())
        {
            $user_arr[] = $row;
        }    
        var_dump($user_arr[0]);    
        break;

    case 'TraerPorId_Usuarios':

        $sql = "SELECT * FROM usuarios WHERE `id`=$id";
        $rs = $con->query($sql);
        $row=$rs->fetch_object();
        var_dump($row);
        break;

    case 'TraerPorEstado_Usuarios':
        $sql = "SELECT * FROM usuarios WHERE `estado`=$estado";
        $rs = $con->query($sql);
        $row=$rs->fetch_object();
        var_dump($row);
        break;

    case 'Agregar_Usuarios':
        $sql = "INSERT INTO `usuarios`(`nombre`, `apellido`, `clave`, `perfil`, `estado`) 
                VALUES ('$nombre','$apellido','$clave',$perfil,$estado)";        
        $rs = $con->query($sql);
        if(mysqli_affected_rows($con) == 1)
        {
            echo "El usuario $nombre ha sido agregado correctamente";
        }
        break;

    case 'Modificar_Usuarios':
        $sql = "UPDATE `usuarios` SET `nombre`='$nombre',`apellido`='$apellido',
                `clave`='$clave',`perfil`=$perfil,`estado`=$estado WHERE `id`=$id";        
        
        $rs = $con->query($sql);
        
        if(mysqli_affected_rows($con) == 1)
        {
            echo "El usuario $nombre ha sido modificado correctamente";
        }
        break;

    case 'Borrar_Usuarios':
        $sql = "DELETE FROM `usuarios` WHERE `id`=$id";  //$id = isset($_POST["id"]) ? $_POST["id"] : NULL; 
                                                        //CAPTURAR ID CONDICIONANDOLO
        echo $sql."\n";      
        $rs = $con->query($sql);
        
        if(mysqli_affected_rows($con) == 1)
        {
            echo "El usuario ha sido eliminado correctamente";
        }
        else
        {
            echo "No se ha podido eliminar el usuario";
        }
        break;

/* -------------------        PRODUCTOS               ------------------------------------- */

    case 'TraerTodos_Productos':
        echo "Traigo todos los productos\n";

        $sql = "SELECT * FROM productos";
        $rs = $con->query($sql);
        
        while ($row = $rs->fetch_object())
        {
            $user_arr[] = $row;
        }    
        var_dump($user_arr[0]);    
        break;

    case 'TraerPorId_Productos':

        $sql = "SELECT * FROM productos WHERE `id`=$id";
        $rs = $con->query($sql);
        $row=$rs->fetch_object();
        var_dump($row);
        break;

    case 'Agregar_Productos':
        $sql = "INSERT INTO `productos`(`codigo_barra`, `nombre`, `path_foto`) 
                VALUES ('$codigo_barra','$nombre','$path_foto')";        
        $rs = $con->query($sql);
        if(mysqli_affected_rows($con) == 1)
        {
            echo "El producto $nombre ha sido agregado correctamente";
        }
        break;

    case 'Modificar_Productos':
        $sql = "UPDATE `productos` SET `nombre`='$nombre',`codigo_barra`='$codigo_barra',
                `path_foto`='$path_foto' WHERE `id`=$id";        
            
        $rs = $con->query($sql);
            
        if(mysqli_affected_rows($con) == 1)
        {
            echo "El producto $nombre ha sido modificado correctamente";
        }
        break;

    case 'Borrar_Productos':
        $sql = "DELETE FROM `productos` WHERE `id`=$id";  //$id = isset($_POST["id"]) ? $_POST["id"] : NULL; 
                                                        //CAPTURAR ID CONDICIONANDOLO
            
        $rs = $con->query($sql);
        
        if(mysqli_affected_rows($con) == 1)
        {
            echo "El producto ha sido eliminado correctamente";
        }
        else
        {
            echo "No se ha podido eliminar el producto";
        }
        break;
    
    default:
        echo "No recibo parametros por POST, revisar!!";
        break;
}

mysqli_close($con);