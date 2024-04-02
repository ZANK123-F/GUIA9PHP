<?php
    //$conexion = mysqli_connect("localhost", "marcos123412341234", "Ro0T12.12.12.", "dssbiblioteca");
    $conexion = mysqli_connect("localhost", "root", "", "biblioteca");
    if ($conexion) {
        echo 'conectado exitosamente a la base de datos';
    } else{
        echo 'no se a podido conectar a la base de datos';
    }

?>