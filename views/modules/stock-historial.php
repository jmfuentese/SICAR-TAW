<?php
//VISTA PARA MODIFICAR EL STOCK DE UN ARTICULO
if(!$_SESSION["validar"]){
    //se valida que este iniciada la sesion de lo contrario se redirecciona a la pagina de ingreso
    echo "<script>window.location.href='index.php?action=ingresar';</script>";
    exit();
}
//se obtiene el id del producto a modificar desde la url
$idP = $_GET["idProducto"];

//se obtienen los datos del producto en cuestion por su respectivo modelo
$producto = DatosProd::getProductModel("productos", $idP);
//se hace una instancia de la clase del controlador
$vistaStock = new ProductsController();
?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid" style="padding: 100px 100px;">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h3 class="card-title" style="display: inline-block;">Agregar Stock</h3>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" >
                    <div class="row">
                        <img src="views/modules/box.png" width="300px" height="300px" style="display: inline-block; float: left; margin: 20px">
                        <div style="display: inline-block; float: left;">
                            <!--Se imprimen los datos del producto-->
                            <p style=" font-size: xx-large">Codigo: <?php echo $producto["codigo_producto"]?></p>
                            <p style=" font-size: xx-large">Nombre: <?php echo $producto["nombre"]?></p>
                            <p style="font-size: xx-large">Fecha agregado: <?php echo $producto["date_added"]?></p>
                            <p style="font-size: xx-large">Precio: <?php echo $producto["precio_producto"]?></p>
                            <p style="font-size: xx-large">Stock actual: <?php echo $producto["cantidad_stock"]?></p>
                        </div>
                    </div>
                    <div>
                        <form method='post' role='form'>
                            <input name="idP" type="hidden" value="<?php echo $idP?>">
                            <button class="btn btn-success" >Agregar stock</button>
                            <input name="addStock" type="text" required>
                        </form>
                        <?php
                        //se agrega el stock
                        $vistaStock -> addStockController();
                        ?>
                        <br>
                        <form method='post' role='form'>
                            <input name="idP" type="hidden" value="<?php echo $idP?>">
                            <button class="btn btn-danger">Eliminar Stock</button>
                            <input name="delStock" type="text" required>
                        </form>
                        <?php
                        //se elimina el stock
                        $vistaStock -> delStockController();
                        ?>

                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-11">
                            <h3 class="card-title" style="display: inline-block;">Historial</h3>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Nota</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Cantidad</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        //se imprime un listado de los movimientos que se han realizado en el stock del articulo en cuestion
                        $vistaStock -> historyListController($idP);
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
</section>
</div>