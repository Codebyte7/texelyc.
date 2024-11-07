<?php
    include_once "../../../conn.php";

    if (isset($_GET['id'])) {
        $getId = $_GET['id'];
        // Realiza la consulta con el ID obtenido
        $querySearch = "SELECT * FROM cliente WHERE ID_Cliente = ?";
        $stmt = $conn->prepare($querySearch);
        $stmt->bind_param("i", $getId); // 'i' indica que es un número entero
        $stmt->execute();
        $resultQuerySearch = $stmt->get_result();
        $record = $resultQuerySearch->fetch_assoc();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="EditUser.css">
</head>
<body> 
    
    <header>
        <div class="buttonBackContainer">
            <a href="Usuario.php"><button>Regresar</button></a>
        </div>
    </header>
    <main>
        <section id="tabEditUser" class="tabContent" role="tabPanel" >
            <form class="formEditUser" action="EditUser.php?id=<?php echo $getId; ?>" method="POST" >
                
                <input type="hidden" name="cliente_id" value="<?php echo $record['ID_Cliente']; ?>"> <!-- Campo oculto con el ID del cliente -->

                <label for="inpUserName">Nombre del Usuario</label>
                <input id="inpUserName" name="inpUserName" type="text" value="<?php echo $record['Cliente_Nombre']?>" required>

                <label for="inpUserEmail">Email</label>
                <input id="inpUserEmail" name="inpUserEmail" type="email" value = "<?php echo $record['Cliente_Correo']?>" required>

                <label for="inpUserPassword"> Contraseña</label>
                <input id="inpUserPassword" name="inpUserPassword" type="password" value = "<?php echo $record['Cliente_Password']?>" required>

                <label for="inpUserPasswordConfirm">Confirmar Contraseña</label>
                <input id="inpUserPasswordConfirm" name="inpUserPasswordConfirm" type="password" required>

                <label for="inpUserNumber">Telefono</label>
                <input id="inpUserNumber" name="inpUserNumber" type="number" value = "<?php echo $record['Cliente_Telefono']?>" required>

                <label for="inpUserAddress">Dirección</label>
                <input id="inpUserAddress" name="inpUserAddress" type="text" value = "<?php echo $record['Cliente_Direccion']?>" required>
                
                <button type="submit">Actualizar</button>
                
            </form>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    $cliente_id = $_POST['cliente_id']; // Obtener el ID del cliente del campo oculto
                    $inpUserName = $_POST['inpUserName'];
                    $inpUserEmail = $_POST['inpUserEmail'];
                    $inpUserPassword = $_POST['inpUserPassword'];
                    $inpUserPasswordConfirm = $_POST['inpUserPasswordConfirm'];
                    $inpUserNumber = $_POST['inpUserNumber'];
                    $inpUserAddress = $_POST['inpUserAddress'];
                    
                    if ($inpUserPassword == $inpUserPasswordConfirm) {
                        
                        // Consulta SQL parametrizada para evitar inyecciones
                        $queryUpdateUser = "UPDATE cliente SET Cliente_Nombre=?, Cliente_Correo=?, Cliente_Password=?, Cliente_Telefono=?, Cliente_Direccion=? WHERE ID_Cliente=?";
                        $stmt = $conn->prepare($queryUpdateUser);
                        $stmt->bind_param("sssssi", $inpUserName, $inpUserEmail, $inpUserPassword, $inpUserNumber, $inpUserAddress, $cliente_id);
                        
                        if ($stmt->execute()) {
                            echo "<script>alert('Usuario Modificado Exitosamente'); window.location.href='Usuario.php';</script>";
                        } else {
                            echo "<script>alert('Error al modificar usuario');</script>";
                        }
                    } else {
                        echo "<script>alert('Las contraseñas no coinciden');</script>";
                    }
                }
            ?>
        </section>
    </main>   
    
</body>
</html>
