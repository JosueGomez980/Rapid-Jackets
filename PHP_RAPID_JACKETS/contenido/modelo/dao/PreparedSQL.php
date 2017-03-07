<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PreparedSQL
 *
 * @author Josué Francisco
 */
final class PreparedSQL {

    // Querys de DML preparados
    // -------Tabla CATEGORIA -----------
    const categoria_insert = "INSERT INTO CATEGORIA (NOMBRE, DESCRIPCION, CATEGORIA_ID_CATEGORIA) VALUES (?,?,?) ;";
    const categoria_update = "UPDATE CATEGORIA SET NOMBRE = ?, DESCRIPCION = ?, CATEGORIA_ID_CATEGORIA = ? WHERE ID_CATEGORIA = ? ;";
    const categoria_delete = "DELETE FROM CATEGORIA WHERE ID_CATEGORIA = ? ;";
    const categoria_find_pk = "SELECT * FROM CATEGORIA WHERE ID_CATEGORIA = ? ;";
    const categoria_find_all = "SELECT * FROM CATEGORIA;";
    const categoria_find_by_fk = "SELECT * FROM CATEGORIA WHERE CATEGORIA_ID_CATEGORIA = ? AND ID_CATEGORIA != ? ;";
    const categoria_disable = "UPDATE CATEGORIA SET ACTIVA = ? WHERE ID_CATEGORIA = ? ;";
    // -------Tabla CATALOGO ------------
    const catalogo_insert = "INSERT INTO CATALOGO (NOMBRE, DESCRIPCION, FOTO) VALUES (?,?,?);";
    const catalogo_delete = "DELETE FROM CATALOGO WHERE ID_CATALOGO = ? ;";
    const catalogo_update = "UPDATE CATALOGO SET NOMBRE = ?, DESCRIPCION = ?, FOTO = ? WHERE ID_CATALOGO = ? ;";
    const catalogo_find_pk = "SELECT * FROM CATALOGO WHERE ID_CATALOGO = ? ;";
    const catalogo_find_all = "SELECT * FROM CATALOGO ;";
    const catalogo_enable_disable = "UPDATE CATALOGO SET ACTIVO = ? WHERE ID_CATALOGO = ? ;";
    //--------Tabla Producto ------------
    const producto_insert = "INSERT INTO PRODUCTO (ID_PRODUCTO, CATEGORIA_ID_CATEGORIA, CATALOGO_ID_CATALOGO, NOMBRE, PRECIO, CANTIDAD, DESCRIPCION, FOTO) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ;";
    const producto_update = "UPDATE PRODUCTO SET CATEGORIA_ID_CATEGORIA = ?, CATALOGO_ID_CATALOGO = ?, NOMBRE = ?, PRECIO = ?, DESCRIPCION = ?, FOTO = ? WHERE ID_PRODUCTO = ? ;";
    const producto_delete = "DELETE FROM PRODUCTO WHERE ID_PRODUCTO = ? ;";
    const producto_find = "SELECT * FROM PRODUCTO WHERE ID_PRODUCTO = ? ;";
    const producto_find_all = "SELECT * FROM PRODUCTO;";
    const producto_find_by_fk = "SELECT * FROM PRODUCTO WHERE CATALOGO_ID_CATALOGO = ? AND CATEGORIA_ID_CATEGORIA = ? ;";
    const producto_enable_disable = "UPDATE PRODUCTO SET ACTIVO = ? WHERE ID_PRODUCTO = ? ;";
    const producto_update_cantidad = "UPDATE PRODUCTO SET CANTIDAD = ? WHERE ID_PRODUCTO = ? ;";

    //--------Busquedas Avanzadas de producto ------------------
    //-- Por nombres
    //-- Por precios-fijo
    //-- Por precios-rango
    //-- Por precio-max-min
    //-------Tabla Inventario del producto
    const inventario_insert = "INSERT INTO INVENTARIO VALUES (?, ?, ?, ?, ?, ?) ; ";
    const inventario_update = "UPDATE INVENTARIO SET FECHA = ?, CANTIDAD = ?, PRECIO_MAYOR = ?, OBSERVACIONES = ? WHERE ID_INVENTARIO = ? AND PRODUCTO_ID_PRODUCTO = ? ;";
    const inventario_delete = "DELETE FROM INVENTARIO WHERE ID_INVENTARIO = ? AND PRODUCTO_ID_PRODUCTO = ? ;";
    const inventario_find = "SELECT * FROM INVENTARIO WHERE ID_INVENTARIO = ? AND PRODUCTO_ID_PRODUCTO = ? ;";
    const inventario_find_all = "SELECT * FROM INVENTARIO ;";
    const inventario_find_by_producto = "SELECT * FROM INVENTARIO WHERE PRODUCTO_ID_PRODUCTO = ? ;";
}
