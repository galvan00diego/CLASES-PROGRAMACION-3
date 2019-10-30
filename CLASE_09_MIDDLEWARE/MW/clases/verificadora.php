<?php 
require "AccesoDatos.php";
require "usuario.php";

class Verificadora
{
    function verifico($request,$response,$next)
    {
        if($request->isGet())
        {
            $response->getBody()->write("GET middleware\n");
            $response=$next($request,$response);
            return $response;
        }
        else
            $response->getBody()->write("POST middleware\n");
            $response=$next($request,$response);
            return $response;
    }

    function verificoTipo($request,$response,$next)
    {
        if($request->isGet()) 
        {
            $response=$next($request,$response);
        }
        else
        {
            $datos=$request->getParsedBody();
            $response->getBody()->write("Verificando credenciales....\n");
            if($datos["tipo"]=="administrador")
            {
                $response->getBody()->write("TIPO: administrador || NOMBRE: ".$datos["nombre"]."\n");
                $response=$next($request,$response);
            }
            else
            {
                $response->getBody()->write("NO TIENE PERMISOS..");
            }
        }
        return $response;
    }

    static function ExisteUsuario($obj)
    {
        $archivo=fopen("login.txt", "r");
        
        while(!feof($archivo))
        {
            $archAux = fgets($archivo);
            $credencialesArch = explode(" - ", $archAux);
            $credencialesArch[0] = trim($credencialesArch[0]);
        }
        fclose($archivo);
        if($obj->nombre==$credencialesArch[0]&&$obj->clave==$credencialesArch[1])
        {
            return TRUE;
        }
        else
        return FALSE;
        
    }

    function mExisteUsuario($request,$response,$next)
    {
        $datos=$request->getParsedBody();
        $response->getBody()->write("Verificando existencia....\n");
        $obj=new StdClass();
        $obj->nombre=$datos["nombre"];
        $obj->clave=$datos["clave"];
        if(Verificadora::ExisteUsuario($obj))
        {
            $response->getBody()->write("El usuario existe\n");
            $response=$next($request,$response);
        }
        else
        {
            $response->getBody()->write("El usuario No existe\n");
        }
        return $response;
    }

    static function ExisteUsuarioBD($request,$response,$next)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $datos=$request->getParsedBody();
        $correo=$datos["correo"];
        $clave=$datos["clave"];

        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios 
                                                        WHERE correo='$correo' AND clave='$clave'");        
        $consulta->execute();
        
         if($consulta->rowCount()>0) //SI EXISTE EL CORREO EN LA BASE DE DATOS, DEVUELVE 1 FILA
         { 
            $user=new StdClass();
            $user->datos=$consulta->FetchObject();
            $response->getBody()->write("Bienvenido ".$user->datos->nombre."\n");
            $response=$next($request,$response);
         }
         else
         {
            $response->getBody()->write("El usuario ingresado no existe");
         }

        return $response;
    
    }

     function metodos($request,$response,$next)
    {
        if($request->isPost())
            {
                $datos=$request->getParsedBody();
                if($datos["tipo"]=="admin")
                {
                    $response->getBody()->write("AGREGO USUARIO\n");
                    $usuario=new usuario();
                    $usuario->nombre=$datos["nombre"];
                    $usuario->apellido=$datos["apellido"];
                    $usuario->correo=$datos["correo"];
                    $usuario->clave=$datos["clave"];
                    $usuario->perfil=$datos["perfil"];
                    $usuario->estado=$datos["estado"];
                    //var_dump($usuario);die();
                    if($usuario->InsertarUsuario())
                    {
                        $response->getBody()->write("El usuario ha sido agregado correctamente");
                    }
                    $response=$next($request,$response);
                }   
                else
                {
                    $response->getBody()->write("NO TIENE PERMISOS");
                }
                return $response;
            }
            else
            {
                
                $response=$next($request,$response);
                $response->getBody()->write("METODOS.... GET.....");
                return $response;
            }
    }
}

?>