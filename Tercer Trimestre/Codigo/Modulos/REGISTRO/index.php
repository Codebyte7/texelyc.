

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

<form method="post">

    <h2>TEXELYC</h2>
    <p>inicia tu registro</p>

    <div class="input-wrapper">
        <input type="text" name="name" placeholder="nombre">
        <img class="input-icon"  src="images/name.svg" alt="">
        
    </div>

    <div class="input-wrapper">
        <input type="email" name="email" placeholder="Correo">
        <img class="input-icon"  src="images/email.svg" alt="">
    </div>

    <div class="input-wrapper">
        <input type="text" name="direction" placeholder="direccion">
        <img class="input-icon"  src="images/direction.svg" alt="">
    </div>

    <div class="input-wrapper">
        <input type="tel" name="phone" placeholder="telefono">
        <img class="input-icon"  src="images/phone.svg" alt="">
    </div>

    <div class="input-wrapper">
        <input type="password" name="password" placeholder="contraseña">
        <img class="input-icon"  src="images/password.svg" alt="">
    </div>

    <input class="btn" type="submit" name="register" value="enviar">

</form>

<?php
    include("registrar.php");
?>
    
</body>
</html>