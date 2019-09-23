<?php
require "figurageometrica.php"; 
class Triangulo extends FiguraGeometrica
{
    private $_altura;
    private $_base;

    public function __construct($altura,$base)
    {
        parent::__construct();
        $this->_altura=$altura;
        $this->_base=$base;
    }

    protected function CalcularDatos($altura,$base)
    {
        
    }
    public function Dibujar(){}
    public function ToString(){}
}