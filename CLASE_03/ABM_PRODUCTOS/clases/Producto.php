<?php

class Producto
{
    private $_nombre;//string
    private $_cod_barra;//string

    public function __CONSTRUCT($cod_barra=NULL,$nombre=NULL)
    {
        if($nombre!=NULL)
        $this->_nombre=$nombre;
        if($cod_barra!=NULL)
        $this->_cod_barra=$cod_barra;
    }

    public function ToString()
    {
        return $this->_cod_barra."-".$this->_nombre."\n";
    }

    public static function Guardar($obj)
    {
        $path_archivo="archivos/Productos.txt";
        $retorno=FALSE;
        $archivo=fopen($path_archivo,"a+");
        $cant=fwrite($archivo,$obj->ToString());
      
        if($cant>0)
        {
            $retorno=TRUE;
        }
        
        fclose($archivo);
        return $retorno;
    }

    public static function Leer()
    {
        $path_archivo="archivos/Productos.txt";
        
        $archivo=fopen($path_archivo,"r+");

        while(!feof($archivo))
        {
            echo fgets($archivo);
        }
        fclose($archivo);
    }

    public static function TraerTodosLosProductos()
    {
        $path_archivo="archivos/Productos.txt";
        $arrayProductos=[];
        $archivo=fopen($path_archivo,"r+");
        while(!feof($archivo))
        {
            array_push($arrayProductos,explode("-",fgets($archivo)));
        }
        var_dump($arrayProductos);

    }
}

