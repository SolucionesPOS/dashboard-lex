<?php
session_start();
ob_start();
$page_title = 'Ventas por susursal';
require_once('includes/load.php');
if (!$session->isUserLoggedIn(true)) {
    redirect('index.php', false);
}
$user = current_user();

$request_date_start = isset($_REQUEST["date_start"]) ? $_REQUEST["date_start"] : date("Y-m-d");
$request_date_end = isset($_REQUEST["date_end"]) ? $_REQUEST["date_end"] : date("Y-m-d");


//REPORTE DE VENTAS POR SUCURSAL
$sales = find_by_sql("SELECT u.name As Vendedor, v.fecha, c.cliente, c.nombre, p.articulo, p.descripcion, 
SUM(i.cantidad) As cantidad, i.precio, 
SUM(i.precio * i.cantidad) AS total 
FROM partida_temps As i 
INNER JOIN venta_temps As v On v.id = i.ventas_id 
INNER JOIN productos As p On i.productos_id = p.id 
INNER JOIN users As u on v.users_id = u.id 
INNER JOIN clientes As c On c.id = v.clientes_id 
WHERE v.fecha >= '{$request_date_start}' AND v.fecha <= '{$request_date_start}' GROUP BY c.cliente, c.nombre, p.articulo, p.descripcion, v.fecha, i.precio, u.name
", true);


?>
<?php include_once('template/header.php'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Reporte de ventas por fecha</h4>
                        </div>
                        <div class="card-body">
                            <form method="GET" class="form-row">
                               
                                <div class="form-group col-md-3">
                                    <label for="date_start">Fecha Inicio</label>
                                    <input type="date" class="form-control" id="date_start" name="date_start" value="<?= $request_date_start ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="date_final">Fecha Final</label>
                                    <input type="date" class="form-control" id="date_end" name="date_end" value="<?= $request_date_end ?>">
                                </div>
                                <div class="form-group col-md-3 ">             
                                    <label><br><br><br></label>                                                           
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filtrar</button>
                                </div>                             
                            </form>
                            <hr>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tableExport" class="table table-striped" id="table-1" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Cliente</th>
                                            <th>Nombre</th>
                                            <th>Estudio</th>
                                            <th>Descripcion</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Total</th>
                                            <th>Vendedor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($sales)) {
                                            foreach ($sales as $key => $item) {
                                        ?>
                                                <tr>
                                                    <td><?= $item["fecha"] ?></td>
                                                    <td><?= $item["cliente"] ?></td>
                                                    <td><?= $item["nombre"] ?></td>
                                                    <td><?= $item["producto"] ?></td>
                                                     <td><?= $item["descripcion"] ?></td>
                                                    
                                                    <td><?= $item["cantidad"] ?></td>
                                                    <td>$<?= number_format($item["precio"], 2) ?></td>
                                                    <td>$<?= number_format($item["total"], 2) ?></td>
                                                    <td><?= $item["Vendedor"] ?></td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="2">No hay dato para mostrar</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->
<?php include_once('template/footer.php'); ?>