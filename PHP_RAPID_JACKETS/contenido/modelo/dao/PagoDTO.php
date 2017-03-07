<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PagoDTO
 *
 * @author Josué Francisco
 */
final class PagoDTO {

    private $facturaIdFactura;
    private $tipoPago;
    private $numeroCuenta;
    private $numeroTarjeta;

    public function __construct() {
        
    }

    public function getFacturaIdFactura() {
        return $this->facturaIdFactura;
    }

    public function getTipoPago() {
        return $this->tipoPago;
    }

    public function getNumeroCuenta() {
        return $this->numeroCuenta;
    }

    public function getNumeroTarjeta() {
        return $this->numeroTarjeta;
    }

    public function setFacturaIdFactura($facturaIdFactura) {
        $this->facturaIdFactura = (string) $facturaIdFactura;
    }

    public function setTipoPago($tipoPago) {
        $this->tipoPago = (string) $tipoPago;
    }

    public function setNumeroCuenta($numeroCuenta) {
        $this->numeroCuenta = (string) $numeroCuenta;
    }

    public function setNumeroTarjeta($numeroTarjeta) {
        $this->numeroTarjeta = (string) $numeroTarjeta;
    }

}
