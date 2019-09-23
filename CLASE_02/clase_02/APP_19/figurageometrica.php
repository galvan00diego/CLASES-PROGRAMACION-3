<?php

abstract class FiguraGeometrica
{
    protected $_color;
    protected $_perimetro;
    protected $_superficie;

    public function __construct()
    {
        // $this->_color=$color;
        // $this->_perimetro=$perimetro;
        // $this->_superficie=$superficie;
    }

    public function getColor(){return $this->_color;}
    public function setColor($color){$this->_color=$color;}

    public function ToString(){}
    public abstract function Dibujar();
    protected abstract function CalcularDatos();
}