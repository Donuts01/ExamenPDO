<?php

require 'config/database.php';

$db = new Database();
$con = $db->conectar();

$IdCliente = $_GET['id'];

$query = $con->prepare("DELETE FROM Clientes WHERE IdCliente=?");
$query->execute([$IdCliente]);
$numElimina = $query->rowCount();
header("Location: nuevoCliente.php");

?>