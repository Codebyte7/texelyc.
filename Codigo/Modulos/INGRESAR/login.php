<?php
include('conexion.php');
$usu = $_POST["usuario"];
$pass = $_POST["password"];
$rol = $_POST["rol"];
$queryusurio = mysqli_query($conexion, "SELECT*from login WHERE usuario = '$usu' AND password = '$pass'and rol = '$rol");
$nr = mysqli_num_rows($queryusurio);
if ($nr == 1) {
    if ($rol == "usuario") {
        header("Location:user.php");
    } else if ($rol == "administrador") {
        header("Location:admin.php");
    }
} else {
    echo "<script alert('usuario,contraseña o rol incorrecto.');window.location= 'index.html'</script>";
}
