<?php

class Archivo{

    public static function Subir()
    {
        $retorno=FALSE;
        $tmp_name = $_FILES["archivo"]["tmp_name"];
        $destino="img/".$_FILES["archivo"]["name"];
        $tipoArchivo = pathinfo($destino, PATHINFO_EXTENSION);
        if(getimagesize($tmp_name)!=FALSE && $tipoArchivo != "jpg")
        {
            $subio=move_uploaded_file($tmp_name,$destino);
            $retorno=TRUE;
        }

        return $retorno;
    }
}