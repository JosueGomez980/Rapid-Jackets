<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoriaDAO
 *
 * @author Josué Francisco
 */
include("CategoriaDTO.php");
include("Conexion.php");
include("PreparedSQL.php");

final class CategoriaDAO {

    private $db;

    public function __construct() {
        $this->db = Conexion::getInstance();
    }

    function insert(CategoriaDTO $categoria) {
        $nombre = $categoria->getNombre();
        $descripcion = $categoria->getDescripcion();
        $cate_id_cate = $categoria->getCategoriaIdCategoria();
        $sentencia = "INSERT INTO CATEGORIA (NOMBRE, DESCRIPCION, CATEGORIA_ID_CATEGORIA) VALUES "
                . "('$nombre','$descripcion',$cate_id_cate);";
        try {
            $conexion = $this->db->creaConexion();
            //$conexion instanceof mysqli;
            $resultado = $conexion->query($sentencia);
            $conexion->close();
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getMessage();
        }
        return($resultado);
    }

    public function delete(CategoriaDTO $categoria) {
        $idCat = $categoria->getIdCategoria();
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::categoria_delete);
            $stmt->bind_param("i", $idCat);
            $res = $stmt->execute();
            $stmt->close();
            $conexion->close();
        } catch (mysqli_sql_exception $ex) {
            echo($ex->getMessage());
        }
        return($res);
    }

    public function findAll() {
        $tablaCategoria = [];
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $resultado = $conexion->query(PreparedSQL::categoria_find_all);
            $resultado instanceof mysqli_result;
            if (!is_null($resultado)) {
                while ($fila = $resultado->fetch_array()) {
                    $categoriaTemp = new CategoriaDTO();
                    $categoriaTemp->setIdCategoria($fila["ID_CATEGORIA"]);
                    $categoriaTemp->setNombre($fila["NOMBRE"]);
                    $categoriaTemp->setActiva($fila["ACTIVA"]);
                    $categoriaTemp->setDescripcion($fila["DESCRIPCION"]);
                    $categoriaTemp->setCategoriaIdCategoria($fila["CATEGORIA_ID_CATEGORIA"]);
                    $tablaCategoria[] = $categoriaTemp;
                }
                $resultado->close();
                $conexion->close();
            }
        } catch (mysqli_sql_exception $ex) {
            echo($ex->getMessage());
        }
        return ($tablaCategoria);
    }

    public function find(CategoriaDTO $categoriaT) {
        $categoria = NULL;
        $idCat = $categoriaT->getIdCategoria();
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::categoria_find_pk);
            $stmt->bind_param("i", $idCat);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $resultado instanceof mysqli_result;
            if ($resultado->num_rows != 0) {
                $fila = $resultado->fetch_array();
                $categoria = new CategoriaDTO();
                $categoria->setIdCategoria($fila["ID_CATEGORIA"]);
                $categoria->setNombre($fila["NOMBRE"]);
                $categoria->setActiva($fila["ACTIVA"]);
                $categoria->setDescripcion($fila["DESCRIPCION"]);
                $categoria->setCategoriaIdCategoria($fila["CATEGORIA_ID_CATEGORIA"]);
            }
            $stmt->close();
            $resultado->close();
            $conexion->close();
        } catch (mysqli_sql_exception $ex) {
            echo($ex->getMessage());
        }
        return $categoria;
    }

    public function findByFK(CategoriaDTO $categoria) {
        $cat_id_cat = $categoria->getCategoriaIdCategoria();
        $tablaCategoria = NULL;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::categoria_find_by_fk);
            $stmt->bind_param("ii", $cat_id_cat, $cat_id_cat);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $resultado instanceof mysqli_result;
            if ($resultado->num_rows != 0) {
                $tablaCategoria = [];
                while ($fila = $resultado->fetch_array()) {
                    $categoriaTemp = new CategoriaDTO();
                    $categoriaTemp->setIdCategoria($fila["ID_CATEGORIA"]);
                    $categoriaTemp->setNombre($fila["NOMBRE"]);
                    $categoriaTemp->setActiva($fila["ACTIVA"]);
                    $categoriaTemp->setDescripcion($fila["DESCRIPCION"]);
                    $categoriaTemp->setCategoriaIdCategoria($fila["CATEGORIA_ID_CATEGORIA"]);
                    $tablaCategoria[] = $categoriaTemp;
                }
                $stmt->close();
                $resultado->close();
                $conexion->close();
            }
        } catch (mysqli_sql_exception $ex) {
            echo($ex->getMessage());
        }
        return $tablaCategoria;
    }

    public function update(CategoriaDTO $catUpdate) {
        $idCat = $catUpdate->getIdCategoria();
        $nombre = $catUpdate->getNombre();
        $descripcion = $catUpdate->getDescripcion();
        $catIdCat = $catUpdate->getCategoriaIdCategoria();
        $res = 0;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::categoria_update);
            $stmt->bind_param("ssii", $nombre, $descripcion, $catIdCat, $idCat);
            $stmt->execute();
            $res = $stmt->affected_rows;
            $stmt->close();
            $conexion->close();
        } catch (mysqli_sql_exception $ex) {
            echo($ex->getMessage());
        }
        return $res;
    }

    public function disable_enable(CategoriaDTO $catDisable) {
        $idCat = $catDisable->getIdCategoria();
        $yn = $catDisable->getActiva();
        $res = 0;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::categoria_disable);
            $stmt->bind_param("ii",$yn, $idCat);
            $stmt->execute();
            $res = $stmt->affected_rows;
            $stmt->close();
            $conexion->close();
        } catch (mysqli_sql_exception $ex) {
            echo($ex->getMessage());
        }
        return($res);
    }

}

?>
