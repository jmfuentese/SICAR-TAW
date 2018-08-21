<?php
/*
VISTA DE CATEGORIAS
*/
if(!$_SESSION["validar"]){
    //Se valida que la sesion este iniciada
    //de lo contrario se redirecciona a la pagina de ingreso al sistema
    echo "<script>window.location.href='index.php?action=ingresar'</script>";
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
                            <h3 class="card-title" style="display: inline-block;">Categorias</h3>
                        </div>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                            Agregar &nbsp&nbsp<i class="right fa fa-plus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Agregado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        //Se crea una instancia del controlador y se invoca el controlador para listar las categorias registradas
                        $vistaCategoria = new ProductsController();
                        $vistaCategoria -> categoryListController();
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

<!--MODAL AGREGAR CATEGORIA-->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar nueva categoria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <form action="" method="post" role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" placeholder="Ingresa el nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" name="descripcion" class="form-control" id="exampleInputEmail1" placeholder="Ingresa una descripcion" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
                <?php
                //Se invoca el controlador para registrar una categoria nueva
                $vistaCategoria -> registerCategoryController();

                ?>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->