<?php
$conex = new mysqli("localhost", "root", "login");

if ($conexion->connect_errno) {
    echo "no hay conexion:(" . $conexion->connect_errno . ")" . $conexion->connect_error;
}
?>
