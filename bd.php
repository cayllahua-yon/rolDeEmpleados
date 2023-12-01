<?php 
$servidor = "localhost";
$baseDeDatos = "dbrolDeEmpleados";
$usuario = "root";
$password = "";
try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$password);
    echo "Conexion exitosa";
} catch (Exception $ex) {
    echo $ex -> getMessage();
}
?> 