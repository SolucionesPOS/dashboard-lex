<?php
session_start();
ob_start();
$page_title = 'Ventas por productos';
require_once('includes/load.php');
if (!$session->isUserLoggedIn(true)) {
    redirect('index.php', false);
}
$user = current_user();


$request_date_start = isset($_REQUEST["date_start"]) ? $_REQUEST["date_start"] : date("Y-m-d");
$request_date_end = isset($_REQUEST["date_end"]) ? $_REQUEST["date_end"] : date("Y-m-d");

$sales = find_by_sql("SELECT p.articulo As Articulo, pr.descripcion As Descripcion,  SUM(p.cantidad) As Cantidad, p.precio, SUM(p.precio * p.cantidad) As Total 
FROM ventparts_temp As p  
INNER JOIN ventas_temp As v ON p.ventas_id = v.id
INNER JOIN productos As pr On pr.producto = p.articulo 
WHERE v.sinc = 1 AND v.fecha >= '{$request_date_start}' <= v.fecha <= '{$request_date_end}'
GROUP BY  p.articulo, pr.descripcion, p.precio", true);


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
                            <h4>Bitacora de Recoleccion</h4>
                        </div>
                        <div class="card-body">
                      
                            <hr>

                            <div class="table-responsive">
                                                                <table class="table table-striped table-hover" id="tableExport" class="table table-striped" id="table-1" style="width:100%;">

                                    <thead>
                                        <tr>
                                       
                                            <th>Nombre</th>                                       
                                            <th>Cantidad</th>                                         
                                            <th>Estatus</s></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($sales)) {
                                            foreach ($sales as $key => $item) {
                                        ?>
                                                <tr>
                                                
                                                    <td><?= $item["Recolector"] ?></td>
                                                 
                                                    <td><?= $item["Cantidad"] ?></td>

                                                    <?php if ($item['Cantidad'] >= 5 AND $item['Cantidad'] <= 10 ) { ?>
                                                      <td> <div class="badge badge-warning">Prevenido</div></td>
                                                    </td>
                                                    <?php } ?>     
                                                    <?php if ($item['Cantidad'] <  5) { ?>
                                                      <td> <div class="badge badge-success">Nomal</div></td>
                                                    </td>
                                                    <?php } ?>     
                                                    <?php if ($item['Cantidad'] > 10 ) { ?>
                                                      <td> <div class="badge badge-danger">Recolectar</div></td>
                                                    </td>
                                                    <?php } ?>     
                                                   
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Reporte de ventas por estudio</h4>
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

                            <div class="table-responsive" >
                                <table class="table table-striped table-hover" id="tableExport" class="table table-striped" id="table-1" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Articulo</th>
                                            <th>Descripción</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Importe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($sales)) {
                                            foreach ($sales as $key => $item) {
                                        ?>
                                                <tr>
                                                    <td><?= $item["Articulo"] ?></td>
                                                    <td><?= $item["Descripcion"] ?></td>
                                                    <td><?= number_format($item["precio"], 2) ?></td>
                                                    <td><?= $item["Cantidad"] ?></td>
                                                    <td><?= number_format($item["Total"], 2) ?></td>
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