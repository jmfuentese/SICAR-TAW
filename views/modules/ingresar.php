<!--INGRESAR-->
<div class="login-box">
        <div class="login-logo">
            <a href="#"><b>SICAR</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Iniciar sesion</p>

                <form  method="post">
                    <div class="form-group has-feedback">
                        <input name="usuario" type="text" class="form-control" placeholder="Usuario" required>
                        <span class="fa fa-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input name="password" type="password" class="form-control" placeholder="Contraseña" required>
                        <span class="fa fa-lock form-control-feedback"></span>
                    </div>
                    <div class="row">

                        <!-- /.col -->
                        <div class="text-center col-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat" name="registro">Entrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <?php
                    //instancia del controlador
                    $ingreso = new ProductsController();
                    //se invoca el controlador para validar el ingreso al sistema
                    $ingreso -> loginController();
                    if(isset($_GET["action"])){
                        //se valida la variable action
                        if($_GET["action"] == "fallo"){
                            //en caso de ser fallo se muestra el siguiente mensaje
                            echo "Fallo al ingresar";
                        }
                    }

                ?>
                <!--<p class="mb-1">
                    <a href="#">I forgot my password</a>
                </p>-->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

