<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - TEXELYC</title>
    <link rel="stylesheet" href="css\estilos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    
<div class="container-all">
    <div class="ctn-form">
        <center><img src="imagenes\p.png" alt="logo"></center>
        <h1 class="title">Iniciar Sesión</h1>

        <form action="">
            <label for="">Email</label>
            <input type="email">
            <label for="">Contraseña</label>
            <input type="password">
            <div class="ub1">rol</div>
            <select name="rol">
                <option value="0" style="display:nome;"><label>seleccionar</label></option>
                <option value="usuario">usuario</option>
                <option value="administrador">administrador</option>
            </select>
            <div aling="center">
                <input type="submit" value="ingresar">
                <input type="reset" value="cancelar">
            </div>
            

        </form>

        <span class="text-footer">¿Aún no te has registrado?
            <a href="#">Registrate</a>
        </spn>
    </div>


</div>
</body>
<script>
    function verpassword() {
        var tipo = document.getElementById("password");
        if (tipo.nodeType == "password") {
            tipo.type = "text";
        }
        else {
            tipo.type = "password";
        }
    }
</script>
</html>