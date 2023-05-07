<?php include("includes/header.php") ?>
<?php include("guardaCliente.php") ?>


<main class="container p-4">

    <h4>Registro de clientes</h4>
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
                <form action="nuevoCliente.php" method="POST" autocomplete="off">
                    <div class="form-group p-3">
                        <label>Nombre Completo</label>
                        <input type="text" name="NombreCliente" class="form-control" placeholder="Ingrese el nombre"
                            required autofocus>
                    </div>
                    <div class="form-group p-3">
                        <label>Apellido Paterno</label>
                        <input type="text" name="ApePatCliente" class="form-control"
                            placeholder="Ingrese el apellido paterno" required>
                    </div>
                    <div class="form-group p-3">
                        <label>Apellido Materno</label>
                        <input type="text" name="ApeMatCliente" class="form-control"
                            placeholder="Ingrese el apellido materno" required>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <a href="index.php" class="btn btn-secondary">Volver</a>
                        </div>
                        <div class="col text-center">
                            <input type="submit" name="GuardarCliente" class="btn btn-success" value="Guardar">
                        </div>

                    </div>

                </form>
            </div>

        </div>

        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $comando = $con->prepare("SELECT IdCliente, NombreCliente, ApePatCliente, ApeMatCliente FROM Clientes ORDER BY IdCliente ASC");
                    $comando->execute();
                    $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($resultado as $row) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $row['IdCliente']; ?>
                            </td>
                            <td>
                                <?php echo $row['NombreCliente']; ?>
                            </td>
                            <td>
                                <?php echo $row['ApePatCliente']; ?>
                            </td>
                            <td>
                                <?php echo $row['ApeMatCliente']; ?>
                            </td>
                            <td>
                                <a href="editarCliente.php?id=<?php echo $row['IdCliente']; ?>" class="btn btn-warning">Editar</a>
                                <a href="eliminarCliente.php?id=<?php echo $row['IdCliente']; ?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>

    </div>

</main>

<?php include("includes/footer.php") ?>