<?php include("includes/header.php") ?>
<?php include("guardaPrestamo.php") ?>

<?php
$IdPrestamo = $_GET['id'];
$query = $con->prepare("SELECT NombreCliente, Monto, Plazos, Fecha  FROM Prestamos WHERE IdPrestamo = :IdPrestamo");
$query->execute(['IdPrestamo' => $IdPrestamo]);
$num = $query->rowCount();
if ($num > 0) {
    $row = $query->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: index.php");
}

$TPrestamo=0;
$TInteres=0;
$TAbono=0;
?>
<main class="container contenedor">
    <div class="row py-3">
        <div class="col">
            <h2>Tabla de amortizacion
            </h2>
            <h4>Cliente:
                <?php echo $row['NombreCliente']; ?>
            </h4>
            <h4>No. pago:
                <?php echo $row['Plazos']; ?>
            </h4>
            <table class="table table-border">
                <thead>
                    <tr>
                        <th>No. pago</th>
                        <th>Fecha</th>
                        <th>Prestamo</th>
                        <th>Interes</th>
                        <th>Abono</th>

                    </tr>
                </thead>

                <tbody>

                    <?php
                    for ($i = 1; $i <= $row['Plazos']; $i++) {

                        //  Calculo de la tabulacion de la amortizacion
                        $Prestamo=($row['Monto']/$row['Plazos']);
                        $Interes=($Prestamo*0.11);
                        $Abono=($Prestamo+$Interes);
                        $Fecha=$row['Fecha'];
                        $Fechainc= date("Y-m-d",strtotime($Fecha."+ ".(2*$i)." week"));
                        // Calculos totales
                        $TPrestamo=$TPrestamo+$Prestamo;
                        $TInteres=$TInteres+$Interes;
                        $TAbono=$TAbono+$Abono;

                        ?>
                        <tr>
                            <td>
                                <?php echo $i; ?>
                            </td>
                            <td>
                                <?php echo $Fechainc; ?>
                            </td>
                            <td>
                                <?php echo "$".$Prestamo; ?>
                            </td>
                            <td>
                                <?php echo "$".$Interes; ?>
                            </td>
                            <td>
                                <?php echo "$".$Abono; ?>
                            </td>
                        
                        </tr>  
                    <?php } ?>
                    </tr>
                        <td></td>
                        <td>
                            Totales
                        </td>                          
                        <td>
                            <?php echo "$".$TPrestamo; ?>
                        </td>
                        <td>
                            <?php echo "$".$TInteres; ?>
                        </td>
                        <td>
                            <?php echo "$".$TAbono; ?>
                        </td>
                    <tr>
                </tbody>
            </table>
            <div>           
            <a href="index.php" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</main>


<?php include("includes/footer.php") ?>