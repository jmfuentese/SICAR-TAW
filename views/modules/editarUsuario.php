<?php

/*
 * Vista para editar proveedores
 * */

if(!$_SESSION["validar"]){
    //se valida que este iniciada la sesion
    // de lo contrario se redirecciona a la pagina de ingreso al sistema
    header("location:index.php?action=ingresar");
    exit();

}
//se crea una nueva instancia del controlador para esta vista
$vistaEditarUsuario = new ProductsController();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>

            </div>
        </div>
    </section>


    <section class="content" style="">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">

                    <div class="card card-white">

                        <div class="card-header">
                            <h1 class="card-title">Modificar Usuario</h1>

                            <div class="card-tools">

                                <a href="index.php?action=usuarios"><button type="button" class="btn btn-tool"><i class="fa fa-remove"></i></button></a>
                            </div>
                        </div>
                        <?php
                            //se obtiene el id del proveedor a editar desde la url
                            $usr = $_GET["usr"];
                            //por medio de un controlador especifico, se obtiene toda la informacion del usuario
                            //para editar sus datoa
                            $usrData = $vistaEditarUsuario->getUserByIdController($usr);

                        ?>
                        <form role="form" style="" method="post">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" placeholder="" name="nombre" value="<?php echo $usrData["first_name"]?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="apellido">Apellido</label>
                                    <input type="text" class="form-control"  placeholder="" name="apellido" value="<?php echo $usrData["last_name"]?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="correo">Email</label>
                                    <input type="text" class="form-control"  placeholder="" name="email" value="<?php echo $usrData["user_email"]?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="rfc">RFC</label>
                                    <input type="text" class="form-control"  placeholder="" name="rfc" value="<?php echo $usrData["rfc"]?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="curp">CURP</label>
                                    <input type="text" class="form-control"  placeholder="" name="curp" value="<?php echo $usrData["curp"]?>" required>
                                </div>


                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info" style="width: 150px;" name="modificar">Guardar Cambios</button>

                            </div>
                            </div>


                        </form>
                        <?php
                            //Controlador para guardar la informacion actualizada del usuario
                            $vistaEditarUsuario->updateUserController($usr);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <img src="views/dist/img/user.png" style="padding:40px 20px 20px 160px;" />
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>