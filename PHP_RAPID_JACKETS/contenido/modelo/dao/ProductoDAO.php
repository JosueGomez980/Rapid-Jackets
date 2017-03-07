<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductoDAO
 *
 * @author Josué Francisco
 */
include("ProductoDTO.php.");
include("Conexion.php");
include("PreparedSQL.php");

final class ProductoDAO {

    private $db;

    public function __construct() {
        $this->db = Conexion::getInstance();
    }

    public function insert(ProductoDTO $proInsert) {
        $idPro = $proInsert->getIdProducto();
        $categoria = $proInsert->getCategoriaIdCategoria();
        $catalogo = $proInsert->getCatalogoIdCatalogo();
        $nombre = $proInsert->getNombre();
        $precio = $proInsert->getPrecio();
        $cantidad = $proInsert->getCantidad();
        $descripcion = $proInsert->getDescripcion();
        $foto = $proInsert->getFoto();
        $res = 0;
        if (is_null($foto)) {
            $foto = "SIN_ASIGNAR";
        }
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::producto_insert);
            $stmt->bind_param("siisdiss", $idPro, $categoria, $catalogo, $nombre, $precio, $cantidad, $descripcion, $foto);
            $stmt->execute();
            $res = $stmt->affected_rows;

            $stmt->close();
            $conexion->close();
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
        return($res);
    }

    public function update(ProductoDTO $proUpdate) {
        $idPro = $proUpdate->getIdProducto();
        $categoria = $proUpdate->getCategoriaIdCategoria();
        $catalogo = $proUpdate->getCatalogoIdCatalogo();
        $nombre = $proUpdate->getNombre();
        $precio = $proUpdate->getPrecio();
        $descripcion = $proUpdate->getDescripcion();
        $foto = $proUpdate->getFoto();
        if (is_null($foto)) {
            $foto = "SIN_ASIGNAR";
        }
        $res = 0;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::producto_update);
            $stmt->bind_param("iisdsss", $categoria, $catalogo, $nombre, $precio, $descripcion, $foto, $idPro);
            $stmt->execute();
            $res = $stmt->affected_rows;

            $stmt->close();
            $conexion->close();
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getMessage();
        }
        return $res;
    }

    public function delete(ProductoDTO $proDelete) {
        $idPro = $proDelete->getIdProducto();
        $res = 0;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::producto_delete);
            $stmt->bind_param("s", $idPro);
            $stmt->execute();
            $res = $stmt->affected_rows;

            $stmt->close();
            $conexion->close();
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getTraceAsString;
        }
        return $res;
    }

    public function disable_enable(ProductoDTO $producto, $yn) {
        $idPro = $producto->getIdProducto();
        $res = 0;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::producto_enable_disable);
            $stmt->bind_param("is", $yn, $idPro);
            $stmt->execute();
            $res = $stmt->affected_rows;

            $stmt->close();
            $conexion->close();
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getTraceAsString;
        }
        return $res;
    }

    public function find(ProductoDTO $proFind) {
        $idPro = $proFind->getIdProducto();
        $producto = NULL;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::producto_find);
            $stmt->bind_param("s", $idPro);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $resultado instanceof mysqli_result;
            if ($resultado->num_rows != 0) {
                $fila = $resultado->fetch_array();
                $producto = new ProductoDTO();
                $producto->setIdProducto($fila["ID_PRODUCTO"]);
                $producto->setCatalogoIdCatalogo($fila["CATALOGO_ID_CATALOGO"]);
                $producto->setCategoriaIdCategoria($fila["CATEGORIA_ID_CATEGORIA"]);
                $producto->setNombre($fila["NOMBRE"]);
                $producto->setPrecio($fila["PRECIO"]);
                $producto->setActivo($fila["ACTIVO"]);
                $producto->setCantidad($fila["CANTIDAD"]);
                $producto->setDescripcion($fila["DESCRIPCION"]);
                $producto->setFoto($fila["FOTO"]);
            }
            $stmt->close();
            $resultado->close();
            $conexion->close();
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getMessage();
        }
        return $producto;
    }

    public function findAll() {
        $tablaProducto = NULL;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $resultado = $conexion->query(PreparedSQL::producto_find_all);
            $resultado instanceof mysqli_result;
            if ($resultado->num_rows != 0) {
                $tablaProducto = [];
                while ($fila = $resultado->fetch_array()) {
                    $producto = new ProductoDTO();
                    $producto->setIdProducto($fila["ID_PRODUCTO"]);
                    $producto->setCatalogoIdCatalogo($fila["CATALOGO_ID_CATALOGO"]);
                    $producto->setCategoriaIdCategoria($fila["CATEGORIA_ID_CATEGORIA"]);
                    $producto->setNombre($fila["NOMBRE"]);
                    $producto->setPrecio($fila["PRECIO"]);
                    $producto->setActivo($fila["ACTIVO"]);
                    $producto->setCantidad($fila["CANTIDAD"]);
                    $producto->setDescripcion($fila["DESCRIPCION"]);
                    $producto->setFoto($fila["FOTO"]);
                    $tablaProducto[] = $producto;
                }
            }
            $resultado->close();
            $conexion->close();
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
        return $tablaProducto;
    }

    public function findByFK(ProductoDTO $proFind) {
        $categoria = $proFind->getCategoriaIdCategoria();
        $catalogo = $proFind->getCatalogoIdCatalogo();
        $tablaProducto = NULL;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::producto_find_by_fk);
            $stmt->bind_param("ii", $catalogo, $categoria);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $resultado instanceof mysqli_result;
            if ($resultado->num_rows != 0) {
                echo($resultado->num_rows);
                $tablaProducto = [];
                while ($fila = $resultado->fetch_array()) {
                    $producto = new ProductoDTO();
                    $producto->setIdProducto($fila["ID_PRODUCTO"]);
                    $producto->setCatalogoIdCatalogo($fila["CATALOGO_ID_CATALOGO"]);
                    $producto->setCategoriaIdCategoria($fila["CATEGORIA_ID_CATEGORIA"]);
                    $producto->setNombre($fila["NOMBRE"]);
                    $producto->setPrecio($fila["PRECIO"]);
                    $producto->setActivo($fila["ACTIVO"]);
                    $producto->setCantidad($fila["CANTIDAD"]);
                    $producto->setDescripcion($fila["DESCRIPCION"]);
                    $producto->setFoto($fila["FOTO"]);
                    $tablaProducto[] = $producto;
                }
            }
            $stmt->close();
            $resultado->close();
            $conexion->close();
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getMessage();
        }
        return $tablaProducto;
    }

}
