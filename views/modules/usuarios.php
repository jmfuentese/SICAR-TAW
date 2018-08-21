<?php
//VISTA DE USUARIOS(PROVEEDORES)
if(!$_SESSION["validar"]){
    //se valida que la sesion este iniciada, de lo contrario se redirige a la pagina de ingreso
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
                            <h3 class="card-title" style="display: inline-block;">Proveedores</h3>
                        </div>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                            Agregar proveedor &nbsp&nbsp<i class="right fa fa-plus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Agregado</th>
                            <th>RFC</th>
                            <th>CURP</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        //se crea la instancia de la clase controller para esta vista
                        $vistaUsuario = new ProductsController();
                        //se listan los proveedores registrados
                        $vistaUsuario -> userListController();
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
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar nuevo proveedor</h4>
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
                            <label for="apellido">Apellido</label>
                            <input type="text" name="apellido" class="form-control" id="exampleInputEmail1" placeholder="Ingresa el apellido" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Ingresa un correo electronico" required>
                        </div>
                        <div class="form-group">
                            <label for="email">RFC</label>
                            <input type="text" name="rfc" class="form-control" placeholder="Ingresa el RFC" required>
                        </div>
                        <div class="form-group">
                            <label for="curp">CURP</label>
                            <input type="text" name="curp" class="form-control" placeholder="Ingresa el CURP" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
                <?php
                    //se registra el nuevo proveedor
                    $vistaUsuario -> registerUserController();
                ?>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




