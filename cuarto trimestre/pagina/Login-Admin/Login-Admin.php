<?php
//http://localhost/texelyc.com/Login-Admin/Admin/Admin-Usuario/Usuario.php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos
    include '../conn.php';

    $correo = $conn->real_escape_string($_POST['correo']);
    $contrasena = $conn->real_escape_string($_POST['password']);

    // Verificar los datos ingresados con la base de datos
    $sql = "SELECT * FROM admin WHERE Admin_Correo='$correo' AND Admin_Contraseña='$contrasena'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Datos correctos, iniciar sesión y redirigir a admin.html
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $correo;
        header("Location: Admin/admin.html");
        exit();
    } else {
        // Datos incorrectos, mostrar mensaje de error
        $error_message = "Correo o contraseña incorrectos.";
    }

    // Cerrar la conexión
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin </title>
    <link rel="stylesheet" href="<link rel=" preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">"

    <link rel="stylesheet" href="../assets/css/Admin_Login_style.css ">
</head>

<body>
    <main>
        <div class="contenedor__todo">

            <div class="caja__trasera">
                <div class="contenedor__login-register">
                    <!--Login-->
                    <form action="Login-Admin.php" method="POST" class="formulario__login">
                        <h2>Iniciar Sesion</h2>
                        <input type="text" placeholder="Correo Electronico" name="correo">
                        <input type="password" placeholder="Contraseña" name="password">
                        <button>Entrar</button>
                    </form>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="Login-Admin.php"></script>
</body>

</html>
