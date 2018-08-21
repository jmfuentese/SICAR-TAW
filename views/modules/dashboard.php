<?php
/*
 * DASHBOARD DEL SISTEMA (PANTALLA PRINCIPAL)
 * Aqui se muestra una breve informacion de lo que sucede en el sistema y se muestra un video explicando el funcionamiento
 * del mismo
 * */
if(!$_SESSION["validar"]){
    //header("location:index.php?action=ingresar");
    echo "<script>window.location.href='index.php?action=ingresar'</script>";
    exit();
}

?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php
                                    //se obtiene el total de productos registrados en el sistema independientemente de su categoria
                                    echo DatosProd::getTotalProductos("productos")["total"];?></h3>

                                <p>Productos en Stock</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="index.php?action=inventario" class="small-box-footer">Productos <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php
                                    //se obtiene el total de movimientos en el stock (entradas y salidas de productos)
                                    echo DatosProd::getTotalRegistros("historial")["total"];?></h3>

                                <p>Movimientos</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="index.php?action=inventario" class="small-box-footer">Inventario <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?php
                                    //se obtiene el total de proveedores registrados en el sistema
                                    echo DatosProd::getTotalRegistros("proveedores")["total"];?></h3>

                                <p>Proveedores registrados</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="index.php?action=usuarios" class="small-box-footer">Proveedores <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?php
                                    //se obtiene el total de categorias registradas en el sistema
                                    echo DatosProd::getTotalRegistros("categoria")["total"];?></h3>

                                <p>Categorias registradas</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="index.php?action=categorias" class="small-box-footer">Categorias <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
            <div class="row" style="width:100%; margin:100px auto; text-align: center;">
                <div align="center" class="container" style="width:70%; ">
                    <h2>Video explicativo de el código fuente</h2>
                    <iframe width="670" height="445" src="https://www.youtube.com/embed/64o3TVZzEbo" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
