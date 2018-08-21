<?php
//VISTA DE PEDIDOS
//Se valida la sesion del usuario, de lo contrario se redirige a la pantalla de ingreso
if(!$_SESSION["validar"]){
    echo "<script>window.location.href='index.php?action=ingresar';</script>";
    exit();
}
$vistaPedidos = new ProductsController();
?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid" style="padding: 40px;">
            <div class="card">
                <div class="card-header">
                    <h1>Historial de pedidos</h1>
                    <div>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-vender">Registrar nuevo pedido &nbsp<i class="fa fa-plus"></i></button>
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
                            <th>Producto</th>
                            <th>Piezas</th>
                            <th>Por pagar $</th>
                            <th>Proveedor</th>
                            <th>Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        //listado de pedidos
                        $vistaPedidos->ordersListController();
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
                <h4 class="modal-title">Nuevo pedido</h4>
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
                                //se listan los proveedores dentro de un select2
                                $vistaPedidos -> getSelectProveedoresListController();
                                ?>

                            </select>

                            <label for="producto">Producto</label>
                            <br>
                            <select name="producto" style="width: 410px;" class="form-control select2 select2-hidden-accessible" required>

                                <?php
                                //se listan los productos dentro de un select2
                                $vistaPedidos -> getSelectProductListController();
                                ?>

                            </select>

                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" class="form-control"  name="cantidad" required>
                            </div>

                        </div>

                        <div class="card-footer">


                            <br>
                            <button type="submit" class="btn btn-success" style="width: 150px;" name="guardar">Registrar</button>
                            <button type="button" class="btn btn-danger" style="width: 150px;" name="cancelar" data-dismiss="modal"><a
                                    href="index.php?action=pedidos" style="color:white;">Cancelar</a></button>

                        </div>

                        <?php
                        //se registra el nuevo pedido
                        $vistaPedidos -> registerPedidoController();

                        ?>

                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->