<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <?php
        include ("./modelo/dao/InventarioDAO.php");
            $inv = new InventarioDTO();
            $inv->setIdInventario("INV#000003");
            $inv->setProductoIdProducto("PRO#000002");
            $inv->setFecha(Conexion::getSQlDateTime());
            $inv->setCantidad(1000);
            $inv->setPrecioMayor(123456789);
            $inv->setObservaciones("El proveedor es gay y sabe matar gente");
            $inventarios = new InventarioDAO();
            $i = $inventarios->findAll();
            echo(var_dump($i));
        ?>
    </body>
</html>
