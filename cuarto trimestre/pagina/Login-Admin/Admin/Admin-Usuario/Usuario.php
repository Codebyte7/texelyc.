<!-- # -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="Usuario.css" class="style">
</head>
<body>
    <header>
        <h2>Administracion de Usuarios</h2>
    </header>

    <!-- Seleecion de opcion de Usuarios -->
    <main>
        <nav class = "tab-menu">
            <button class="tab" id="Bttn_SearchUser" onclick="openTab(event, tabSearchUser)" aria-controls="tabSearchUser">
                <img src="../../../assets/images/Admin/search-user.png" alt="Busqueda de usuario">
            </button>

            <button class="tab tab-hide" id="Bttn_AddUser" onclick="openTab(event, tabAddUser)" aria-controls="tabAddUser" >
                <img src="../../../assets/images/Admin/add-user.png" alt="Agregar Usuario">
            </button>
        </nav>

        
<!--Section para Buscar Usuarios, editarlos y Eliminarlos-->
        <section id="tabSearchUser" class="tabContent" role="tabPanel">  
         <div class="searchContainer">
             <form action="Usuario.php" method="POST">
                 <label for="select-typeSearch">Índice de Búsqueda</label>
                 <select name="select-typeSearch" id="select-typeSearch">
                     <option value="">Seleccione índice de Búsqueda</option>
                     <option value="ID_Cliente">ID</option>
                     <option value="Cliente_Nombre">Nombre</option>
                     <option value="Cliente_Telefono">Teléfono</option>
                     <option value="Cliente_Correo">Correo</option>
                     <option value="Cliente_Direccion">Dirección</option>
                 </select>
                 <input id="searchUserInput" name="searchUserInput" type="text">
                 <button type="submit">Buscar</button>
             </form>
             <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST") {  //verifica que el metodo de entrada sea POST
                    require_once '../../../conn.php'; //conexion a la base de datos que retorna un aviso en caso de conexion exitosa

                    $typeSearch = $_POST['select-typeSearch'];  //obtiene el indice de busqueda del formulario
                    $searchInput = $_POST['searchUserInput'];    //Obtiene el valor de busqueda del formulario

                    if (!empty($typeSearch) && !empty($searchInput)) { //Verifica que ambos campos no estén vacios
                        
                        /*  Crear la consulta en SQL
                            SELECT(Seleccionar) *(all) FORM(de) cliente(tablaBD) WHERE(donde) $typeSearch(value de select en form) LIKE(sea igual a) ?(valor de $typeSearch)
                            de esta manera ubica la columna pr al cual ba a indexar la busqueda */
                        $querySearch = "SELECT * FROM cliente WHERE $typeSearch LIKE ?"; 

                        //$stmt(variable que ejecutará la consulta y almacenará la columna de la tabla como resultado) 
                        $stmt = $conn ->prepare($querySearch);

                        //Concatena el valor ingresado para busqueda con el comodin %, el cual permite realizar consultas flexibles en SQL, por ejemplo informacion parcial
                        $searchInput = "%" . $searchInput . "%";
                        //send value of input to search into query and specific the type of value to variable (practicando el inglish :D  )
                        $stmt-> bind_param("s", $searchInput);
                        //Se ejecuta la consulta
                        $stmt -> execute(); 
                        //se guardan los datos obtenidos de la consulta
                        $result = $stmt->get_result(); 

                        //verifica que el resultado contenga mas de 0 filas
                        if ($result->num_rows > 0) {

                            echo "
                            <table class='userResultSearchTable'>";
                            echo "
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th>Dirección</th>
                                </tr>";

                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" .$row['ID_Cliente'] . "</td>";
                                echo "<td>" .$row['Cliente_Nombre']."</td>";
                                echo "<td>" .$row['Cliente_Telefono']."</td>";
                                echo "<td>" .$row['Cliente_Correo']. "</td>";
                                echo "<td>" .$row['Cliente_Direccion']. "</td>";
                                echo "
                                    <td class='userOptionBttnCont'>
                                        <a href='Usuario.php?id=".$row['ID_Cliente'] ."' class='openModalBtn'>
                                            <button class='userOptionBttn' type='button'>
                                                <img src='../../../assets/images/Admin/edit-user.png' alt='EditUser'>
                                            </button>        
                                        </a>
                                        <button class='userOptionBttn' type='button'>
                                            <img src='../../../assets/images/Admin/delete-user1.png' alt='DeleteUser'>
                                        </button>

                                    </td>";                                    
                            }
                            echo "</table>";
                        }else{
                            echo 'no se encontraron resultados';
                        }

                    }else {
                        echo 'Verifique los datos ingresados';
                    }
                    
                    //Editar Usuario

                }
             ?>

             
         </div>
        </section>

    <!-- Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span id="closeModalBtn" class="close">&times;</span>
            <h2>Editar Información del Usuario</h2>

 
            <form class="formEditUser" action="EditUser.php?id=<?php echo $getId; ?>" method="POST">
                <input type="hidden" name="cliente_id" value="<?php echo $record['ID_Cliente']; ?>"> <!-- Campo oculto con el ID del cliente -->
<
                <label for="inpUserName">Nombre del Usuario</label>
                <input id="inpUserName" name="inpUserName" type="text" value="<?php echo $record['Cliente_Nombre']?>" required>

                <label for="inpUserEmail">Email</label>
                <input id="inpUserEmail" name="inpUserEmail" type="email" value = "<?php echo $record['Cliente_Correo']?>" required>

                <label for="inpUserPassword">Contraseña</label>
                <input id="inpUserPassword" name="inpUserPassword" type="text" value = "<?php echo $record['Cliente_Password']?>" required>

                <label for="inpUserPasswordConfirm">Confirmar Contraseña</label>
                <input id="inpUserPasswordConfirm" name="inpUserPasswordConfirm" type="text" required>

                <label for="inpUserNumber">Teléfono</label>
                <input id="inpUserNumber" name="inpUserNumber" type="number" value = "<?php echo $record['Cliente_Telefono']?>" required>

                <label for="inpUserAddress">Dirección</label>
                <input id="inpUserAddress" name="inpUserAddress" type="text" value = "<?php echo $record['Cliente_Direccion']?>" required>

                <button type="submit">Actualizar</button>
            </form>
        </div>
    </div>



        <section id="tabAddUser" class="tabContent" role="tabPanel" >
            <form class="formAddUser" action="AddUser.php" method="POST" >
    
                <label for="inpUserName">Nombre del Usuario</label>
                <input id="inpUserName" name="inpUserName" type="text" required>

                <label for="inpUserEmail">Email</label>
                <input id="inpUserEmail" name="inpUserEmail" type="email" required>

                <label for="inpUserEmailConfirm">Confirmar Email</label>
                <input id="inpUserEmailConfirm" name="inpUserEmailConfirm" type="email" required>

                <label for="inpUserPassword"> Contraseña</label>
                <input id="inpUserPassword" name="inpUserPassword" type="text"required>

                <label for="inpUserPasswordConfirm">Confirmar Contraseña</label>
                <input id="inpUserPasswordConfirm" name="inpUserPasswordConfirm" type="text"required>

                <label for="inpUserNumber">Telefono</label>
                <input id="inpUserNumber" name="inpUserNumber" type="number" required>

                <label for="inpUserAddress">Dirección</label>
                <input id="inpUserAddress" name="inpUserAddress" type="text"required>
                
                <button type="submit">Agregar</button>
                
            </form>

        </section>
    </main>
    
    <script src="Usuario.js"></script>
</body>
</html>
