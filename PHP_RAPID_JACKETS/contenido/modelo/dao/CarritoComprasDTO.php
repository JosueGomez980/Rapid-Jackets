<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CarritoCompras
 *
 * @author Josué Francisco
 */
final class CarritoComprasDTO {

    private $idCarrito;
    private $total;
    private $subtotal;
    private $impuestos;

    public function __construct() {
        
    }

    public function getIdCarrito() {
        return $this->idCarrito;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getSubtotal() {
        return $this->subtotal;
    }

    public function getImpuestos() {
        return $this->impuestos;
    }

    public function setIdCarrito($idCarrito) {
        $this->idCarrito = (string) $idCarrito;
    }

    public function setTotal($total) {
        $this->total = (double) $total;
    }

    public function setSubtotal($subtotal) {
        $this->subtotal = (double) $subtotal;
    }

    public function setImpuestos($impuestos) {
        $this->impuestos = (double) $impuestos;
    }

}
