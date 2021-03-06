<?php
class usuario
{
    public $id;
    public $nombre;
    public $apellido;
    public $clave;
    public $perfil;
    public $estado;
    public $correo;


    //buscar por correo y clave
    /*
    metodo existeenBD(correo,clave):bool
    */ 
    public function existeUsuario($usuario)
    {
        $existe=FALSE;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios 
                                                        WHERE correo='$usuario->correo' AND clave='$usuario->clave'");        
        //echo $usuario->correo." - ".$usuario->clave;
        $consulta->execute();
        //echo $consulta->rowCount();
         if($consulta->rowCount()>0) //SI EXISTE EL CORREO EN LA BASE DE DATOS, DEVUELVE 1 FILA
         $existe=TRUE;                  // POR LO QUE ROWCOUNT SERA 1, INGRESANDO AL IF

        return $existe;
    }

    /*
    crear pagina test_usuario.php , case existe_bd
    clave=usuario_login
    valor=json(correo,clave)
    retorno json(existe(bool))
    */

    public function MostrarDatos()
    {
            return $this->id." - ".$this->nombre." - ".$this->apellido." - ".$this->perfil." - "
                        .$this->estado." - ".$this->correo;
    }
    
    public static function TraerTodosLosUsuarios()
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios");        
        
        $consulta->execute();
        
        $consulta->setFetchMode(PDO::FETCH_INTO, new usuario);                                                

        return $consulta; 
    }
    
    public function InsertarUsuario()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios ( nombre, apellido, clave,
                                                        perfil, estado, correo)
                                                    VALUES( :nombre, :apellido, :clave,
                                                        :perfil,:estado,:correo)");
        
        //$consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':estado', $this->estado, PDO::PARAM_INT);
        $consulta->bindValue(':perfil', $this->perfil, PDO::PARAM_INT);
        $consulta->bindValue(':correo', $this->correo, PDO::PARAM_STR);

        $consulta->execute();   

    }
    
    public static function ModificarUsuario($id, $nombre, $apellido, $clave)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuarios SET nombre = :nombre, apellido = :apellido, 
                                                        clave = :clave WHERE id = :id");
        
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $apellido, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $clave, PDO::PARAM_STR);

        return $consulta->execute();

    }

    public static function EliminarUsuario($usuario)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM usuarios WHERE id = :id");
        
        $consulta->bindValue(':id', $usuario->id, PDO::PARAM_INT);

        return $consulta->execute();

    }
    
}