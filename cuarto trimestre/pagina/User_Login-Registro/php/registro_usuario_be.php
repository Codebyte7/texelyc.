<?php

include "conexion_be.php";

$nombre_completo = $_POST["nombre_completo"];
$correo = $_POST["correo"];
$usuario = $_POST["usuario"];
$contrasena = $_POST["contrasena"];

$query = "INSERT INTO cliente(Cliente_Nombre, Cliente_Correo, Cliente Dirección, Cliente_Password) VALUES('$nombre_completo','$correo','$usuario','$contrasena')";


if (strpos($correo, '@') === false) {
    echo "Ingrese un correo valido";
    header("Location: ..\User_Log-Reg.html");
}

/*verificar que el correo nose repita */

$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");

if (mysqli_num_rows($verificar_correo) > 0) {
    echo '
    <script>
    alert("Este correo ya esta registrado, intente con otro correo ");
    window.location="../User_Log-Reg.html";
    </script>
    ';
    exit();
}
/*verificar que el usuario nose repita */

$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario'");

if (mysqli_num_rows($verificar_usuario) > 0) {
    echo '
    <script>
    alert("Este correo ya esta registrado, intente con otro nombre de usuario");
    window.location="../User_Log-Reg.html";
    </script>
    ';
    exit();
}

$ejecutar = mysqli_query($conexion, $query);
if ($ejecutar) {
    echo '
    <script>
        alert("Usuario almacenado exitosamente");
        window.location = "../User_Log-Reg.html";
    </script>

    ';
} else {
    echo '
    <script>
    alert("intentalo de nuevo,usuario no almacenado");
    window.location="../User_Log-Reg.html";
    </script>
    ';
}
mysqli_close($conexion);
