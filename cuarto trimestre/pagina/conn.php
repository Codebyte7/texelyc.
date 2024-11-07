
<?php
$servername = "localhost";
$username = "root";
$password = "";
$port = "3306";
$dbname = "texelyc";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die ("ConexionFallida");
}else{
    /*
    echo ("<script>alert('Conexion de BD Exitosa');</script>");
    */
}
?>