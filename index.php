<?php
require 'config/database.php';
$db = new Database();
$con = $db->conectar();



$filtro="";
?>

<?php include("includes/header.php") ?>

<main class="container p-4">
    <div class="p-3 rounded">
        <div class="row">
            <div class="col-12">
                <h3>Registro de prestamos
                </h3>
            </div>
            <div class="form-group p-3">
                <h5> Cliente
                </h5>
            </div>
            <form action="index.php" method="POST" autocomplete="off">
            <div class="form-group">
                <input type="text" name="BuscarCliente" class="form-control" placeholder="Busca un cliente por nombre"
                     autofocus>
            </div>
            <div class="form-group p-3">
                <input type="submit" name="BuscarClientes" id="BuscarCliente" class="btn btn-success" value="Buscar">
            </div>
            <div>
                <a href="nuevoCliente.php" class="btn btn-primary float-right p-2">Nuevo Cliente</a>
                <a href="nuevoPrestamo.php" class="btn btn-primary float-right p-2">Nuevo Prestamo</a>
            </div>
            </form>
        </div>

        <div class="row py-3">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Monto del prestamo</th>
                            <th>Plazos</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        
                        if(isset($_POST['BuscarCliente']) == ''){
                            $filtro="";
                            
                        }
                        else{
                            if(isset($_POST['BuscarCliente']) != ''){
                                $filtro="WHERE NombreCliente LIKE '%".$_POST['BuscarCliente']."%' ";
                                
                            }
                            
                        }
                        $comando = $con->prepare("SELECT IdPrestamo, NombreCliente, Monto, Plazos FROM Prestamos $filtro ORDER BY IdPrestamo ASC");
                        $comando->execute();
                        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($resultado as $row) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['IdPrestamo']; ?>
                                </td>
                                <td>
                                    <?php echo $row['NombreCliente']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Monto']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Plazos']; ?>
                                </td>
                                <td><a href="Amortizaciones.php?id=<?php echo $row['IdPrestamo']; ?>"
                                        class="btn btn-warning">
                                        <img src='3b.png' alt="Opciones" />
                                    </a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include("includes/footer.php") ?>