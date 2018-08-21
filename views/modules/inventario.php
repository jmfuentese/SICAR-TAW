<?php
    //INVENTARIO, AJUSTE DE INVENTARIOS Y ARTICULOS
	if(!$_SESSION["validar"]){
		//se valida que este iniciada la sesion
        //de lo contrario se redirige a la pagina de ingreso al sistema
        echo "<script>window.location.href='index.php?action=ingresar';</script>";
		exit();
	}

?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid" style="padding: 40px;">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-11">
                            <h3 class="card-title" style="display: inline-block;">Inventario</h3>
                        </div>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-agregar-producto">
                            Agregar articulo &nbsp&nbsp<i class="right fa fa-plus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="inventario" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Agregado</th>
                            <th>$ Venta</th>
                            <th>$ Compra</th>
                            <th>Utilidad</th>
                            <th>Stock</th>
                            <th>Categoria</th>
                            <th>Ajuste inv/Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        //instancia del controlador para esta vista
                        $vistaProductos = new ProductsController();
                        //se invoca el controlador para el listado de articulos
                        $vistaProductos -> productsListController();
                        //$vistaUsuario -> borrarUsuarioController();
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

<div class="modal fade" id="modal-agregar-producto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar nuevo articulo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <form action="" method="post" role="form">
                    <div class="box-body">
                        <div class="form-group row">
                            <div class="col-xs-1">
                                <label for="nombre">Código</label>
                                <input type="text" name="codigo" class="form-control" id="exampleInputEmail1" placeholder="Ingresa el codigo" required>
                            </div>
                            <div class="col">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" placeholder="Ingresa el nombre" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea class="form-control" name="descripcion" id="descripcion"  rows="2" placeholder="Ingresa la descripcion del producto" required></textarea>

                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <label for="compra">Precio venta</label>
                                <input type="text" name="precio" class="form-control" id="exampleInputEmail1" placeholder="precio de compra" required>
                            </div>
                            <div class="col">
                                <label for="venta">Precio compra</label>
                                <input type="text" name="precio_compra" class="form-control" id="exampleInputEmail1" placeholder="precio de venta" required>
                            </div>
                            <div class="col">
                                <label for="utilidad">% Utilidad</label>
                                <input type="text" name="utilidad" class="form-control" id="exampleInputEmail1" placeholder="utilidad" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="text" name="stock" class="form-control" id="exampleInputEmail1" placeholder="Ingresa el stock inicial" required>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label>Categoria</label>
                                <select name="categoria" class="form-control select2" style="width: 100%;" required>
                                    <?php
                                    //listado de categorias dentro de un select
                                    $vistaProductos -> getSelectCategoryListController();
                                    ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
                <?php
                //controlador para registrar un nuevo producto
                $vistaProductos -> registerProductController();

                ?>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
