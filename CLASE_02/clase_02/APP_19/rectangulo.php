<?php 
require "figurageometrica.php";
class Rectangulo extends FiguraGeometrica
{
    private $_ladoUno;
    private $_ladoDos;

    public function __construct($ladoUno,$ladoDos)
    {
        parent::__construct();
        $this->_ladoUno=$ladoUno;
        $this->_ladoDos=$ladoDos;
        CalcularDatos();
    }

    protected function CalcularDatos()
    {
        
    }
    public function Dibujar(){}
    public function ToString(){}
}