<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductoDTO
 *
 * @author Josué Francisco
 */
final class ProductoDTO {

    private $idProducto;
    private $categoriaIdCategoria;
    private $catalogoIdCatalogo;
    private $nombre;
    private $precio;
    private $activo;
    private $cantidad;
    private $descripcion;
    private $foto;

    function __construct() {
        
    }

    function getIdProducto() {
        return $this->idProducto;
    }

    function getCategoriaIdCategoria() {
        return $this->categoriaIdCategoria;
    }

    function getCatalogoIdCatalogo() {
        return $this->catalogoIdCatalogo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getActivo() {
        return $this->activo;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFoto() {
        return $this->foto;
    }

    function setIdProducto($idProducto) {
        $this->idProducto = (string) $idProducto;
    }

    function setCategoriaIdCategoria($categoriaIdCategoria) {
        $this->categoriaIdCategoria = (int) $categoriaIdCategoria;
    }

    function setCatalogoIdCatalogo($catalogoIdCatalogo) {
        $this->catalogoIdCatalogo = (int) $catalogoIdCatalogo;
    }

    function setNombre($nombre) {
        $this->nombre = (string) $nombre;
    }

    function setPrecio($precio) {
        $this->precio = (double) $precio;
    }

    function setActivo($activo) {
        $this->activo = (boolean) $activo;
    }

    function setCantidad($cantidad) {
        $this->cantidad = (int) $cantidad;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = (string) $descripcion;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

}
