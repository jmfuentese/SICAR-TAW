<?php
//Se valida la sesion del usuario, de lo contrario se redirige a la pantalla de ingreso
if(!$_SESSION["validar"]){
    //header("location:index.php?action=ingresar");
    echo "<script>window.location.href='index.php?action=ingresar';</script>";
    exit();
}
$vistaVentas = new ProductsController();
?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid" style="padding: 40px;">
            <div class="card">
                <div class="card-header">
                    <h1>Historial de ventas</h1>
                    <div>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-vender">Registrar nueva venta &nbsp<i class="fa fa-plus"></i></button>
                    </div>
                    <br>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Número</th>
                            <th>Fecha</th>
                            <th>Producto vendido</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Cliente</th>
                            <th>Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        //listado de ventas

                        $vistaVentas->salesListController();
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
</div>
</section>
</div>

<div class="modal fade" id="modal-vender">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Registrar venta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <form role="form" style="width: 450px;" method="post">

                    <div class="card-body">
                        <div class="form-group">
                            <label for="cliente">Cliente</label>
                            <br>
                            <select name="cliente" style="width: 410px;" class="form-control select2 select2-hidden-accessible" required>

                                <?php
                                //listado de clientes dentro de un selec2
                                $vistaVentas -> getSelectClientesListController();
                                ?>

                            </select>

                            <label for="producto">Producto</label>
                            <br>
                            <select name="producto" style="width: 410px;" class="form-control select2 select2-hidden-accessible" required>

                                <?php
                                //listado de productos dentro de un select2
                                $vistaVentas -> getSelectProductListController();
                                ?>

                            </select>

                            <div class="form-group row">
                                <div class="col-xs-1">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="number" class="form-control"  name="cantidad" value="1" min="1" required>
                                </div>
                                <div class="col">
                                    <label for="descuento">Descuento</label>
                                    <input type="text" name="descuento" class="form-control" id="exampleInputEmail1" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="metodo">Metodo de pago</label>
                                <select name="metodo" id="metodo" class="form-control select2 select2-hidden-accessible" required>
                                    <option value="1">Efectivo</option>
                                    <option value="2">Tarjeta</option>
                                    <option value="3">Vales</option>
                                    <option value="4">Cheque</option>
                                    <option value="5">Transferencia</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ref">Referencia</label>
                                <input type="text" name="referencia" class="form-control" required>
                            </div>

                        </div>

                        <div class="card-footer">
                            <br>
                            <button type="submit" class="btn btn-success" style="width: 150px;" name="guardar">Registrar Venta</button>
                            <button type="button" class="btn btn-danger" style="width: 150px;" name="guardar"><a
                                        href="index.php?action=ventas" style="color:white;">Cancelar Venta</a></button>

                        </div>

                        <?php
                        //se registra la nueva venta
                        $vistaVentas -> registerSaleController();

                        ?>



                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->