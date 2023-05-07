<?php include("includes/header.php") ?>


<?php include("guardaPrestamo.php") ?>
<?php

$comando = $con->prepare("SELECT IdCliente, CONCAT(NombreCliente, ' ', ApePatCliente,' ',ApeMatCliente) As NombreCompleto  FROM clientes");
$comando->execute();
$resultado = $comando->fetchAll(PDO::FETCH_ASSOC);

?>


<main class="container p-4">
    <h4>Registro de prestamos</h4>
    <form action="nuevoPrestamo.php" method="POST" autocomplete="off">
        <div class="row">
            <?php if ($correcto) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Exito al guardar
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } else { ?>
                <h3> </h3>
            <?php } ?>
            <div class="col-md-6">
                <div class="form-group p-3">
                    <label>Cliente</label>
                    <select name="NombreCliente" class="form-select" aria-label="Default select example" required>
                        <option selected disabled value="">Seleccione un cliente</option>
                        <?php
                        foreach ($resultado as $row) {
                            ?>
                            <option id="NombreCliente" name="NombreCliente" value='<?php echo $row['NombreCompleto']; ?>'><?php echo $row['NombreCompleto']; ?></option>

                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group p-3">
                    <label>Monto</label>
                    <select name="Monto" class="form-select" aria-label="Default select example" required>
                        <option selected disabled value="">Seleccione un monto</option>
                        <option value="100">$100</option>
                        <option value="200">$200</option>
                        <option value="300">$300</option>
                        <option value="400">$400</option>
                        <option value="500">$500</option>
                        <option value="600">$600</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group p-3">
                    <label>Plazo</label>
                    <select name="Plazos" class="form-select" aria-label="Default select example" required>
                        <option selected disabled value="">Seleccione un plazo</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>
            </div>



        </div>
        <div class="row p-5">
            <div class="col">
                <a href="index.php" class="btn btn-secondary">Volver</a>
                <input type="submit" name="GuardarPrestamo" class="btn btn-success" value="Guardar">
            </div>
        </div>
    </form>
</main>
<?php include("includes/footer.php") ?>