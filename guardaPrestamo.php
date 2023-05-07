<?php

require 'config/database.php';

$db = new Database();
$con = $db->conectar();

$correcto = false;


if (isset($_POST['GuardarPrestamo'])) {
    $NombreCliente = $_POST['NombreCliente'];
    $Monto = $_POST['Monto'];
    $Plazos = $_POST['Plazos'];

    $query = $con->prepare("INSERT INTO Prestamos (NombreCliente, Monto, Plazos) VALUES ( :nc, :m, :p)");
    $resultado = $query->execute(array('nc' => $NombreCliente, 'm' => $Monto, 'p' => $Plazos));
    
    if ($resultado) {
        $correcto = true;
        
        
    }
    
    
} 


?>