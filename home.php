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


$fecha = date("Y-m-d");

$studios =find_by_sql("SELECT u.nombre As Vendedor, 
c.cliente As Cliente,
  c.nombre As NombreC, 
  p.descripcion As Estudio, 
  Sum(i.cantidad) As Cantidad, 
  v.hora As Creado 
  FROM ventparts_temp As i 
  INNER JOIN productos As p On i.articulo = p.producto 
  INNER JOIN ventas_temp As v ON i.ventas_id = v.id 
  INNER JOIN users As u On v.users_id = u.id 
  INNER JOIN clientes AS c On v.clientes_id = c.id 
  WHERE v.sinc = 0 AND v.fecha ='{$fecha}' GROUP BY u.nombre, c.cliente, c.nombre, p.descripcion, i.cantidad, v.hora ORDER BY u.nombre, c.nombre asc ", true);



//REPORTE DE VENTAS POR SUCURSAL
$sales = find_by_sql("SELECT u.nombre As Recolector, SUM(i.cantidad) As Cantidad 
FROM ventparts_temp As i 
INNER JOIN ventas_temp As v ON i.ventas_id = v.id
INNER JOIN users As u On v.users_id = u.id	
INNER JOIN productos As p On i.articulo = p.producto
WHERE v.sinc = 0 AND v.fecha = '{$fecha}' 
GROUP BY u.nombre ", true);


?>
<?php include_once('template/header.php'); ?>


            <script>
               setTimeout(function(){
                   location.reload();
               },95000); 
            </script>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            
 
            </script>
                     <div class="row ">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">New Booking</h5>
                          <h2 class="mb-3 font-18">258</h2>
                          <p class="mb-0"><span class="col-green">10%</span> Increase</p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/1.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15"> Customers</h5>
                          <h2 class="mb-3 font-18">1,287</h2>
                          <p class="mb-0"><span class="col-orange">09%</span> Decrease</p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/2.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">New Project</h5>
                          <h2 class="mb-3 font-18">128</h2>
                          <p class="mb-0"><span class="col-green">18%</span>
                            Increase</p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/3.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Revenue</h5>
                          <h2 class="mb-3 font-18">$48,697</h2>
                          <p class="mb-0"><span class="col-green">42%</span> Increase</p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/4.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
                            <h4>Bitacora de Recolección</h4>
                        </div>
                        <div class="card-body">
                      
                            <hr>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table-1" style="width:100%;">
                                    <thead>
                                        <tr>
                                        <th>Vendedor</th>  
                                        <th>Cliente</th>  
                                            <th>Nombre</th>                                       
                                            <th>Estudio</th>                                         
                                            <th>Cantidad</s></th>
                                            <th>Creado</s></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($studios)) {
                                            foreach ($studios as $key => $item) {
                                        ?>
                                                <tr>
                                                
                                                    <td><?= $item["Vendedor"] ?></td>                                          
                                                    <td><?= $item["Cliente"] ?></td>
                                                    <td><?= $item["NombreC"] ?></td>
                                                    <td><?= $item["Estudio"] ?></td>
                                                    <td><?= $item["Cantidad"] ?></td>
                                                    <td><?= $item["Creado"] ?></td>

                                                    
                                                   
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