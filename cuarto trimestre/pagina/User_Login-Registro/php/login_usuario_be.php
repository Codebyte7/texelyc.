<?php

session_start();

include 'conexion_be.php';

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$validar_login = mysqli_query($conexion, "SELECT * FROM cliente WHERE Cliente_Correo = '$correo'
and Cliente_Contrasena = '$contrasena'");

if (mysqli_num_rows($validar_login) > 0) {
    $_SESSION['usuario'] = $correo;
    header("Location:../../index.html");
    exit;
} else {
    echo '
    <script>
    alert("Usuario no existe,por favor verifique los datos introsducidos");
    window.location = "../../index.php";
    </script>
    ';
    exit;
}
?> 