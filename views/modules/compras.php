<?php
/*
 * VISTA DE COMPRAS
 * */
//Se valida la sesion del usuario, de lo contrario se redirige a la pantalla de ingreso
if(!$_SESSION["validar"]){
    //header("location:index.php?action=ingresar");
    echo "<script>window.location.href='index.php?action=ingresar';</script>";
    exit();
}
$vistaCompras = new ProductsController();
?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid" style="padding: 40px;">
            <div class="card">
                <div class="card-header">
                    <h1>Historial de compras</h1>
                    <div>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-vender">Registrar nueva compra &nbsp<i class="fa fa-plus"></i></button>
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
                            <th>Producto comprado</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Proveedor</th>
                            <th>Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        //listado de ventas

                        $vistaCompras->comprasListController();
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
                <h4 class="modal-title">Nueva compra</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <form role="form" style="width: 450px;" method="post">

                    <div class="card-body">
                        <div class="form-group">
                            <label for="proveedor">Proveedor</label>
                            <br>
                            <select name="proveedor" style="width: 410px;" class="form-control select2 select2-hidden-accessible" required>

                                <?php
                                //controlador para mostrar los proveedores dentro de un select2
                                $vistaCompras -> getSelectProveedoresListController();
                                ?>

                            </select>

                            <label for="producto">Producto</label>
                            <br>
                            <select name="producto" style="width: 410px;" class="form-control select2 select2-hidden-accessible" required>

                                <?php
                                //controlador para mostrar los productos dentro de un select2
                                $vistaCompras -> getSelectProductListController();
                                ?>

                            </select>
                            <div class="form-group row">
                                <div class="col-xs-1">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="number" class="form-control"  name="cantidad" value="1" min="1" required>
                                </div>
                                <div class="col">
                                    <label for="utilidad">Margen de utilidad %</label>
                                    <input type="text" name="utilidad" class="form-control" id="exampleInputEmail1" value="5%" disabled required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-1">
                                    <label for="factor">Factor</label>
                                    <input type="text" class="form-control"  name="factor" value="1.000" disabled required>
                                </div>
                                <div class="col">
                                    <label for="iva">IVA</label>
                                    <input type="text" name="iva" class="form-control" id="exampleInputEmail1" value="16%" disabled required>
                                </div>
                            </div>


                        </div>

                        <div class="card-footer">


                            <br>
                            <button type="submit" class="btn btn-success" style="width: 150px;" name="guardar">Registrar</button>
                            <button type="button" class="btn btn-danger" style="width: 150px;" name="guardar"><a
                                    href="index.php?action=compras" style="color:white;">Cancelar</a></button>

                        </div>

                        <?php
                        //controlador para registrar una nueva compra
                        $vistaCompras -> registerCompraController();

                        ?>

                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->