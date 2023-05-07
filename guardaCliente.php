<?php

require 'config/database.php';

$db = new Database();
$con = $db->conectar();

$correcto = false;


if (isset($_POST['GuardarCliente'])) {
    $NombreCliente = $_POST['NombreCliente'];
    $ApePatCliente = $_POST['ApePatCliente'];
    $ApeMatCliente = $_POST['ApeMatCliente'];

    $query = $con->prepare("INSERT INTO Clientes (NombreCliente, ApePatCliente, ApeMatCliente) VALUES (:nc, :app, :apm)");
    $resultado = $query->execute(array('nc' => $NombreCliente, 'app' => $ApePatCliente, 'apm' => $ApeMatCliente));
    
    if ($resultado) {
        $correcto = true;
        
        
    }
    
    
} 

if (isset($_POST['EditarCliente'])) {
    $IdCliente = $_POST['IdCliente'];
    $NombreCliente = $_POST['NombreCliente'];
    $ApePatCliente = $_POST['ApePatCliente'];
    $ApeMatCliente = $_POST['ApeMatCliente'];

    $query = $con->prepare("UPDATE Clientes SET NombreCliente=?, ApePatCliente=?, ApeMatCliente=? WHERE IdCliente=?");
    $resultado = $query->execute(array($NombreCliente, $ApePatCliente, $ApeMatCliente, $IdCliente));

    if ($resultado) {
        $correcto = true;
    }
    
    
} 

?>
