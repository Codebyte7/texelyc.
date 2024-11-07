<?php //Script para agregar Usuario

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include_once ("../../../conn.php");
        
        //Guardar en variables los datos ingresados en el formulario por medio de atributo name en el input (html)
        $inpUserName = $_POST['inpUserName'];
        $inpUserEmail = $_POST['inpUserEmail'];
        $inpUserEmailConfirm = $_POST['inpUserEmailConfirm'];
        $inpUserPassword = $_POST['inpUserPassword'];
        $inpUserPasswordConfirm = $_POST['inpUserPasswordConfirm'];
        $inpUserNumber = $_POST['inpUserNumber'];
        $inpUserAddress = $_POST['inpUserAddress'];
        
        //Comparar igualdad de valores en Email y Password
        if (($inpUserEmail == $inpUserEmailConfirm)&&($inpUserPassword == $inpUserPasswordConfirm)) { 
            //echo ("<script>alert('datos SI Coinciden')</script>"); //Test
            /*Query para comparar si ya existe un correo igual al ingresado, 
                "?" representa el valor que se envia por medio de bind param en la preparacion de la consulta*/
            $queryCompareUserEmail = "SELECT * FROM cliente WHERE Cliente_Correo LIKE ?";
            //Preparar la consulta, lo cual evita vulnerabilidad de injection, permite el control de la consulta, Buena practica de programacion. 
            $prepareQueryCompareUserEmail = $conn->prepare($queryCompareUserEmail);
            //bind_param asegura que los datos se envien con formato correcto en este caso "s" representa STRING,  Buena practica de programacion. 
            $prepareQueryCompareUserEmail->bind_param("s",$inpUserEmail);
            //Ejecutar la consulta
            $prepareQueryCompareUserEmail->execute();
            //Almacenar respuesta de la consulta.
            $resultQueryCompareUserEmail = $prepareQueryCompareUserEmail->get_result();
            //debug ver valores de result
                //print_r ($resultQueryCompareUserEmail); 
            //comparar numero de filas obtenidas es mayor a 0 , confirmando correo existente en BD
            if ($resultQueryCompareUserEmail-> num_rows > 0) {
                echo (" <script>
                        alert('Correo ya existente en Base de Datos')
                        window.location.href = 'Usuario.php';
                    </script>");
                
            }else { // en caso de no ser mayor a 0, permite agregar datos a la base de datos 
                //Query que agrega al Cliente a la tabla de Usuarios con los valores almacenados en las variables, tener en cuenta que van entre comillas Simples
                $queryAddUser = "INSERT INTO cliente (Cliente_Nombre, Cliente_Telefono, Cliente_Correo, Cliente_Password, Cliente_Direccion ) VALUES ('$inpUserName', '$inpUserNumber', '$inpUserEmail', '$inpUserPassword', '$inpUserAddress')";
                $conn->query($queryAddUser);
                echo (" <script>
                        alert('Usuario Agregado, Verificar Base de datos')
                        window.location.href = 'Usuario.php';
                    </script>");
            }                        
        }else{
            echo (" <script>
                        alert('datos NO Coinciden')
                        window.location.href = 'Usuario.php';
                    </script>");        
                            
        }
    }
    
?>