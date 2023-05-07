<?php include("guardaCliente.php") ?>
<?php
$IdCliente = $_GET['id'];
$query = $con->prepare("SELECT NombreCliente, ApePatCliente, ApeMatCliente FROM Clientes WHERE IdCliente = :IdCliente");
$query->execute(['IdCliente' => $IdCliente]);
$num = $query->rowCount();
if ($num > 0) {
    $row = $query->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: nuevoCliente.php");
}
?>
 
<?php include("includes/header.php") ?>



<main class="container p-4">

    <h4>Editar cliente</h4>
    <div class="row">
        <?php if ($correcto) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Exito al guardar
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } else { ?>
            <h3> </h3>
        <?php } ?>
        <div class="col-md-4">

            <div class="card card-body">
                <form action="editarCliente.php" method="POST" autocomplete="off">
                    <input type="hidden" id="IdCliente" name="IdCliente" value="<?php echo $IdCliente; ?>">
                    <div class="form-group p-3">
                        <label>Nombre Completo</label>
                        <input type="text" name="NombreCliente" class="form-control" placeholder="Ingrese el nombre"
                        value="<?php echo $row['NombreCliente']; ?>" required autofocus>
                    </div>
                    <div class="form-group p-3">
                        <label>Apellido Paterno</label>
                        <input type="text" name="ApePatCliente" class="form-control"
                            placeholder="Ingrese el apellido paterno" value="<?php echo $row['ApePatCliente']; ?>" required>
                    </div>
                    <div class="form-group p-3">
                        <label>Apellido Materno</label>
                        <input type="text" name="ApeMatCliente" class="form-control"
                            placeholder="Ingrese el apellido materno" value="<?php echo $row['ApeMatCliente']; ?>" required>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <a href="nuevoCliente.php" class="btn btn-secondary">Volver</a>
                        </div>
                        <div class="col text-center">
                            <input type="submit" name="EditarCliente" class="btn btn-success" value="Guardar">
                        </div>

                    </div>

                </form>
            </div>

        </div>


    </div>



<?php include("includes/footer.php") ?>
</main>