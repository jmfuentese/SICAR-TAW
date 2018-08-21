<?php
    //CLASE CONTROLLER DE LA CUAL SE DERIVAN TODOS LOS CONTROLADORES UTILIZADOS EN EL SISTEMA
	class ProductsController{
        //controlador para cargar el template utilizado en el sistema
		public function template(){
			include "views/template.php";
		}

		//controlador para los redireccionamientos del sistema o rutas
        //funciona a traves de la variable action, la cual se mantiene en el url y cambia dependiendo
        //de la vista en la que se encuentre
		public function productsLinks(){
		    //se valida que este inicializada la variable action
			if(isset($_GET["action"])){
			    //se obtiene el valor de la variable
				$link = $_GET["action"];
			}else{
			    //si no tiene un valor se le coloca index
				$link = "index";
			}
            //a traves del modelo de rutas se determina la siguiente vista
			$resp = Pages::linkPagesM($link);
            //se retorna la  nueva url
			include $resp;
		}

		//controlador para validar el acceso al sistema
		public static function loginController(){
		    //se valida el campo usuario
            if(isset($_POST["usuario"])){
                //se prepara un array asociativo con usuario y contraseña ingresados
                $datos = array( "usuario"=>$_POST["usuario"], "password"=>md5($_POST["password"]));
                //se envian los datos al modelo para verificarlos con los registros de la BD
                $respuesta = DatosProd::loginModel("usuarios",$datos);
                //Valiación de la respuesta del modelo para ver si es un usuario correcto.
                if($respuesta["usuario"] == $_POST["usuario"] && $respuesta["password"] == md5($_POST["password"])){
                    //se inicializan las variables de sesion
                    $_SESSION["validar"] = true;
                    $_SESSION["usuario"] = $_POST["usuario"];
                    $_SESSION["password"] = $_POST["password"];
                    $_SESSION["privilegio"] = $respuesta["privilegio"];
                    $_SESSION["tienda"] = $respuesta["id_tienda"];
                    $_SESSION["fecha"] = date("Y-m-d h:i:s");
                    //una vez hechas las validaciones e inicializaciones se redirecciona al dashboard
                    echo "<script>window.location.href = 'index.php?action=dashboard'</script>";
                }else{
                    //en caso de no encontrar las credenciales se muestra un mensaje de error
                    echo "<script>
                            swal({
                              type:'error',
                              title: 'Error! Verifica tus credenciales.',
                              showConfirmButton: false,
                              timer:2000
                            },
                            function () {
                                window.location.href = 'index.php?action=fallo';
                                tr.hide();
                             });
                        </script>";
                }

            }
		}

		//Controlador para registrar un nuevo proveedor
		public static function registerUserController(){
		    //se valida que todos los campos esten inicializados
            if(isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"]) && isset($_POST["rfc"]) && isset($_POST["curp"])){
                //se prepara un array asociativo con todos los datos
                $datos = array( "nombre"=>$_POST["nombre"], "apellido"=>$_POST["apellido"],
                    "email"=>$_POST["email"], "date"=>date("Y-m-d h:i:s"), "rfc"=>$_POST["rfc"], "curp"=>$_POST["curp"]);
                $respuesta =  new DatosProd();
                //se envian los datos al modelo para registrar un nuevo proveedor
                $respuesta->registerUserModel("proveedores",$datos);
                //se valida la respuesta
                if($respuesta){
                    //en caso de ser registrado se muestra un mensaje de exito y se redirecciona
                    echo "<script>
                            swal({
                              type:'success',
                              title: 'Proveedor registrado exitosamente!',
                              showConfirmButton: false,
                              timer:2500
                            },
                            function () {
                                window.location.href = 'index.php?action=usuarios';
                                tr.hide();
                             });
                          </script>";
                }else{
                    //en caso de error se muestra el mensaje y se redirecciona
                    echo "<script>
                            swal({
                              type:'error',
                              title: 'Hubo un error al registrar el proveedor!',
                              showConfirmButton: false,
                              timer:2500
                            },
                            function () {
                                window.location.href = 'index.php?action=usuarios';
                                tr.hide();
                             });
                        </script>";
                }

            }
        }

        //Controlador para actualizar los datos del proveedor
        public static function updateUserController($usr){
		    //se validan los datos del proveedor
            if(isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["rfc"]) && isset($_POST["curp"])){
                //se prepara un array con los nuevos datos
                $datos = array( "nombre"=>$_POST["nombre"], "apellido"=>$_POST["apellido"],
                    "email"=>$_POST["email"], "rfc"=>$_POST["rfc"], "curp"=>$_POST["curp"]);
                $respuesta =  new DatosProd();
                //se envian los datos al modelo para actualizar el registro en la BD
                $r = $respuesta->updateUserModel("proveedores",$datos, $usr);
                //se valida la respuesta
                if($r){
                    //en caso de actualizarse se muestra un mensaje de exito y se redirecciona
                    echo "<script>
                            swal({
                              type:'success',
                              title: 'Proveedor actualizado exitosamente!',
                              showConfirmButton: false,
                              timer:2500
                            },
                            function () {
                                window.location.href = 'index.php?action=usuarios';
                                tr.hide();
                             }
                            );
                          </script>";
                }else{
                    echo "<script>
                            swal({
                              type:'error',
                              title: 'Hubo un error al actualizar el proveedor!',
                              showConfirmButton: false,
                              timer:2500
                            },
                            function () {
                                window.location.href = 'index.php?action=usuarios';
                                tr.hide();
                             });
                        </script>";
                }

            }
        }

        //Controlador para registrar una nueva venta
        public static function registerSaleController(){
		    //se valida que los campos del formulario no esten vacios
            if(isset($_POST["cliente"]) && isset($_POST["producto"]) && isset($_POST["cantidad"])){
                //se obtienen los datos del producto
                $prod = DatosProd::getProductByNameModel("productos", $_POST["producto"]);
                //se valida que exista el stock necesario para poder realizar la venta
                if ($_POST["cantidad"]<=$prod["cantidad_stock"]){
                    //se actualiza el stock por medio del modelo correspondiente
                    DatosProd::delStockModel("productos", $_POST["cantidad"], $prod["id"]);
                    //se calcula el total cobrado en la venta multiplicando la cantidad vendida por el precio de venta del producto
                    $total = (int)$_POST["cantidad"] * $prod["precio_producto"];
                    //se prepara el array con los datos para registrar la venta
                    $datos = array("cliente"=>$_POST["cliente"], "fecha"=>date("Y-m-d h:i:s"), "producto"=>$_POST["producto"],"cantidad"=>$_POST["cantidad"],
                        "total"=>$total);
                    $respuesta =  new DatosProd();
                    //se registra la venta
                    $respuesta->registerSaleModel("ventas",$datos);
                    if($respuesta){
                        //se muestra el mensaje de exito
                        echo "<script>
                                    swal({
                                      type:'success',
                                      title: 'Venta registrada exitosamente!',
                                      showConfirmButton: false,
                                      timer:2500
                                    },
                                    function () {
                                        window.location.href = 'index.php?action=ventas';
                                        tr.hide();
                                     });
                                </script>";
                    }else{
                        //mensaje de error
                        echo "<script>
                                    swal({
                                      type:'error',
                                      title: 'Hubo un error al registrar la venta!',
                                      showConfirmButton: false,
                                      timer:2500
                                    },
                                    function () {
                                        window.location.href = 'index.php?action=ventas';
                                        tr.hide();
                                     });
                                </script>";

                    }
                }else{
                    //en caso de no haber stock suficiente se muestra el mensaje correspondiente
                    echo "<script>
                            swal({
                              type:'error',
                              title: 'Stock insuficiente! No se completó la venta.',
                              showConfirmButton: false,
                              timer:2500
                            },
                            function () {
                                window.location.href = 'index.php?action=ventas';
                                tr.hide();
                             });
                        </script>";

                }
            }
        }

        //Controlador para registrar una nueva compra
        public static function registerCompraController(){
		    //se valida que los campos no esten vacios
            if(isset($_POST["proveedor"]) && isset($_POST["producto"]) && isset($_POST["cantidad"])){
                //se obtienen los datos del producto tomando su nombre
                $prod = DatosProd::getProductByNameModel("productos", $_POST["producto"]);
                //se calcula el total pagado por los productos multiplicando la cantidad por el precio de
                $total = (int)$_POST["cantidad"] * $prod["precio_compra"];
                DatosProd::addStockModel("productos", $_POST["cantidad"], $prod["id"]);

                $datos = array("fecha"=>date("Y-m-d h:i:s"), "producto"=>$_POST["producto"],"cantidad"=>$_POST["cantidad"],
                    "total"=>$total, "proveedor"=>$_POST["proveedor"]);

                $respuesta =  new DatosProd();
                $respuesta->registerCompraModel("compras",$datos);
                if($respuesta){
                    //session_start();
                    echo "<script>
                                    swal({
                                      type:'success',
                                      title: 'Compra registrada exitosamente!',
                                      showConfirmButton: false,
                                      timer:2500
                                    },
                                    function () {
                                        window.location.href = 'index.php?action=compras';
                                        tr.hide();
                                     });
                                </script>";
                }else{
                    echo "<script>
                                    swal({
                                      type:'error',
                                      title: 'Hubo un error al registrar la compra!',
                                      showConfirmButton: false,
                                      timer:2500
                                    },
                                    function () {
                                        window.location.href = 'index.php?action=compras';
                                        tr.hide();
                                     });
                                </script>";

                }
            }
        }

        //controlador para registrar un nuevo pedido
        public static function registerPedidoController(){
		    //se validan los campos
            if(isset($_POST["proveedor"]) && isset($_POST["producto"]) && isset($_POST["cantidad"])){
                //se obtienen los datos del producto
                $prod = DatosProd::getProductByNameModel("productos", $_POST["producto"]);
                //se calcula el total del pedido
                $total = (int)$_POST["cantidad"] * $prod["precio_producto"];
                //se prepara el array con los datos del pedido
                $datos = array("fecha"=>date("Y-m-d h:i:s"), "producto"=>$_POST["producto"],"cantidad"=>$_POST["cantidad"],
                    "total"=>$total, "proveedor"=>$_POST["proveedor"]);

                $respuesta =  new DatosProd();
                //se realiza el registro del pedido
                $respuesta->registerCompraModel("pedidos",$datos);
                //validacion de la respuesta
                if($respuesta){
                    //mensaje de exito en caso de registrarse el pedido
                    echo "<script>
                                    swal({
                                      type:'success',
                                      title: 'Pedido registrado exitosamente!',
                                      showConfirmButton: false,
                                      timer:2500
                                    },
                                    function () {
                                        window.location.href = 'index.php?action=pedidos';
                                        tr.hide();
                                     });
                                </script>";
                }else{
                    echo "<script>
                        swal({
                          type:'error',
                          title: 'Hubo un error al registrar el pedido!',
                          showConfirmButton: false,
                          timer:2500
                        },
                        function () {
                            window.location.href = 'index.php?action=pedidos';
                            tr.hide();
                         });
                    </script>";

                }
            }
        }

        //controlador para listar los proveedores
		public static function userListController(){
		    //se obtiene el listado completo de proveedores
            $respuesta = DatosProd::userListModel("proveedores");

            //a traves de un ciclo se imprime cada registro
            foreach($respuesta as $row => $item){
                //se imprimen los datos de cada registro en forma de tabla
                echo'<tr>
				<td>'.$item["id"].'</td>
				<td>'.$item["first_name"].'</td>
				<td>'.$item["last_name"].'</td>
				<td>'.$item["user_email"].'</td>
				<td>'.$item["date_added"].'</td>
				<td>'.$item["rfc"].'</td>
				<td>'.$item["curp"].'</td>
				<td><a href="index.php?action=editarUsuario&usr='.$item["id"].'"><button class="btn btn-default" ><i class="right fa  fa-edit"></i></button></a>
				
				<a href="index.php?action=borrarUsuario&idUsuario='.$item["id"].'"><button class="btn btn-danger"><i class="right fa fa-trash"></i></button></a></td>
			</tr>';

            }
        }

        //se obtienen los datos de un usuario en especifico por NOMBRE
        public static function getUserByNameController($usr){
		    //el parametro es el nombre del usuario
            //se llama el modelo para la consulta de los datos del usuario
		    $usrData = DatosProd::getUserByNameModel("users", $usr);
            //se retornan los datos del usuario
		    return $usrData;
        }

        //se obtienen los datos de un usuario en especifico por ID
        public static function getUserByIdController($usr){
            //el parametro es el id del usuario
            //se llama el modelo para la consulta de los datos del usuario
            $usrData = DatosProd::getUserByIdModel("proveedores", $usr);
            //se retornan los datos del usuario
            return $usrData;
        }

        //controlador para registrar una nueva categoria
        public static function registerCategoryController(){
		    //se validan los campos del formulario
            if(isset($_POST["nombre"]) && isset($_POST["descripcion"])){
                //se prepara el array con los datos de la categoria
                $datos = array( "nombre"=>$_POST["nombre"], "descripcion"=>$_POST["descripcion"], "date"=>date("Y-m-d h:i:s"));
                $respuesta =  new DatosProd();
                //se envian los datos al modelo correspondiente para registrar la nueva categoria
                $respuesta->registerCategoryModel("categoria",$datos);
                if($respuesta){
                    //se muestra el mensaje de exito
                    echo "<script>
                            swal({
                              type:'success',
                              title: 'Categoria registrada exitosamente!',
                              showConfirmButton: false,
                              timer:1500
                            },
                            function () {
                                window.location.href = 'index.php?action=categorias';
                                tr.hide();
                             });
                        </script>";
                }else{
                    echo "<script>
                            swal({
                              type:'error',
                              title: 'Hubo un error al registrar la categoria!',
                              showConfirmButton: false,
                              timer:2500
                            },
                            function () {
                                window.location.href = 'index.php?action=categorias';
                                tr.hide();
                             });
                        </script>";
                }

            }
        }

        //controlador para registrar un nuevo producto
        public static function registerProductController(){
		    //se validan los campos del formulario
            if(isset($_POST["codigo"]) && isset($_POST["nombre"]) && isset($_POST["descripcion"]) && isset($_POST["precio"])
                && isset($_POST["precio_compra"]) && isset($_POST["utilidad"]) && isset($_POST["stock"]) && isset($_POST["categoria"])){
                //se obtienen los datos de la categoria seleccionada
                $category = DatosProd::getCategoryByNameModel("categoria", $_POST["categoria"]);

                //se prepara el array con los datos del registro del nuevo producto
                $datos = array( "codigo"=>$_POST["codigo"], "nombre"=>$_POST["nombre"], "descripcion"=>$_POST["descripcion"],
                    "precio"=>$_POST["precio"], "precio_compra"=>$_POST["precio_compra"], "utilidad"=>$_POST["utilidad"],
                    "stock"=>$_POST["stock"], "categoria"=>$category["id_categoria"],"date"=>date("Y-m-d h:i:s"));
                $respuesta =  new DatosProd();
                //se envian los datos al modelo para registrar el nuevo producto
                $respuesta->registerProductModel("productos",$datos);

                if($respuesta){
                    echo "<script>
                            swal({
                              type:'success',
                              title: 'Producto registrado exitosamente!',
                              showConfirmButton: false,
                              timer:2500
                            },
                            function () {
                                window.location.href = 'index.php?action=inventario';
                                tr.hide();
                             });
                        </script>";

                }else{
                    echo "<script>
                            swal({
                              type:'error',
                              title: 'Hubo un error al registrar el producto!',
                              showConfirmButton: false,
                              timer:2500
                            },
                            function () {
                                window.location.href = 'index.php?action=inventario';
                                tr.hide();
                             });
                        </script>";
                }

            }
        }

        //controlador para agregar el stock a un producto en especifico
        public static function addStockController(){
		    //se valida el campo del stock
            if(isset($_POST["addStock"])){
                //se castea el valor del campo a un tipo entero
                $stock = (int)$_POST["addStock"];
                //se obtiene el id del producto en cuestion
                $idP = $_POST["idP"];

                $addStock =  new DatosProd();
                //se manda el stock al modelo para ser sumado al stock existente del producto
                $respuesta = $addStock->addStockModel("productos",$stock, $idP);
                //Valiación de la respuesta del modelo para ver si es un usuario correcto.
                if($respuesta){
                    //se prepara la informacion para el historial de cambios del stock
                    //se obtiene el nombre del usuario logeado
                    $usr = $_SESSION["usuario"];
                    //se prepara una nota de la accion que el usuario realizo
                    $nota = "El usuario ".$usr." ha agregado ".(string)$stock;
                    //se obtiene la fecha
                    $date = date("Y-m-d h:i:s");
                    //se registra la accion en el historial de ajustes
                    $addStock->historialAdd("historial", $idP, $nota, $usr, $date, $stock);
                    echo "<script>
                            swal({
                              type:'success',
                              title: 'Stock actualizado correctamente!',
                              showConfirmButton: false,
                              timer:2500
                            },
                            function () {
                                window.location.href = 'index.php?action=inventario';
                                tr.hide();
                             });
                        </script>";
                }else{

                    echo "<script>
                            swal({
                              type:'error',
                              title: 'Hubo un error al actualizar el stock!',
                              showConfirmButton: false,
                              timer:2500
                            },
                            function () {
                                window.location.href = 'index.php?action=inventario';
                                tr.hide();
                             });
                        </script>";
                }

            }
        }

        //controlador para eliminar o restar stock de un articulo
        public static function delStockController(){
		    //se valida el campo de stock a eliminar
            if(isset($_POST["delStock"])){
                //se castea el valor del stock a un valor entero
                $stock = (int)$_POST["delStock"];
                //se obtiene el id del producto en cuestion
                $idP = $_POST["idP"];
                $stockMod =  new DatosProd();
                //se manda el stock al modelo apra restar al stock existente
                $respuesta = $stockMod->delStockModel("productos",$stock, $idP);
                //Valiación de la respuesta del modelo para ver si es un usuario correcto.
                if($respuesta){
                    //se prepara la informacion para el historial de ajustes
                    $usr = $_SESSION["usuario"];
                    $nota = "El usuario ".(string)$usr. " ha eliminado ".(string)$stock;
                    $date = date("Y-m-d h:i:s");
                    $stockMod->historialAdd("historial", $idP, $nota, $usr, $date, $stock);
                    echo "<script>
                            swal({
                              type:'success',
                              title: 'Stock actualizado correctamente!',
                              showConfirmButton: false,
                              timer:2500
                            },
                            function () {
                                window.location.href = 'index.php?action=inventario';
                                tr.hide();
                             });
                        </script>";
                }else{

                    echo "<script>
                            swal({
                              type:'error',
                              title: 'Hubo un error al actualizar el stock!',
                              showConfirmButton: false,
                              timer:2500
                            },
                            function () {
                                window.location.href = 'index.php?action=inventario';
                                tr.hide();
                             });
                        </script>";
                }

            }
        }

        //controlador para listar ls categorias registradas
        public static function categoryListController(){
		    //se obtienen todos los registros de categorias mediante el modelo categoryList
            $respuesta = DatosProd::categoryListModel("categoria");

            //mediante un ciclo se imprimen todos los registros existentes
            foreach($respuesta as $row => $item){
                //se imprimen todos los datos de cada registro dentro de una tabla
                echo'<tr>
				<td>'.$item["id_categoria"].'</td>
				<td>'.$item["nombre_categoria"].'</td>
				<td>'.$item["descripcion_categoria"].'</td>
				<td>'.$item["date_added"].'</td>
				<td>
				<a href="index.php?action=borrarCategoria&idCategoria='.$item["id_categoria"].'"><button class="btn btn-danger"><i class="right fa fa-trash"></i></button></a></td>
			</tr>';

            }
        }

        //controlador para listar el historial de ajustes de inventario de un producto en especifico
        public static function historyListController($idP){
		    //se obtienen todos los registros
            $respuesta = DatosProd::historyListModel("historial", $idP);

            //se imprimen los registros dentro de una tabla
            foreach($respuesta as $row => $item){
                $product = DatosProd::getProductModel("productos", $item["id_producto"]);
                echo'<tr>
                        <td>'.$item["id"].'</td>
                        <td>'.$product["nombre"].'</td>
                        <td>'.$item["nota"].'</td>
                        <td>'.$item["usuario"].'</td>
                        <td>'.$item["fecha"].'</td>
                        <td>'.$item["cantidad"].'</td>
                    </tr>';

            }
        }

        //se obtienen los registros de productos para imprimirlos dentro de un select
        public static function getSelectProductListController(){
            $respuesta = DatosProd::productsListModel("productos", $_SESSION["tienda"]);

            foreach($respuesta as $row => $item){
                echo '<option>'.$item["nombre"].'</option>';
            }
        }

        //se obtienen los registros de clientes para imprimirlos dentro de un select
        public static function getSelectClientesListController(){
            $respuesta = DatosProd::categoryListModel("clientes");

            foreach($respuesta as $row => $item){
                echo '<option>'.$item["nombre"].'</option>';
            }
        }

        //se obtienen los registros de proveedores para imprimirlos dentro de un select
        public static function getSelectProveedoresListController(){
            $respuesta = DatosProd::categoryListModel("proveedores");

            foreach($respuesta as $row => $item){
                echo '<option>'.$item["first_name"]." ".$item["last_name"].'</option>';
            }
        }

        //se obtienen los registros de categorias para imprimirlos dentro de un select
        public static function getSelectCategoryListController(){
            $respuesta = DatosProd::categoryListModel("categoria");

            foreach($respuesta as $row => $item){
                echo '<option>'.$item["nombre_categoria"].'</option>';
            }
        }

        //controlador para listar los productos registrados en el sistema
        public static function productsListController(){
		    //se obtienen todos los registros
            $respuesta = DatosProd::productsListModel("productos");

            //se imprimen los registros dentro de una tabla
            foreach($respuesta as $row => $item){
                $categoria = DatosProd::getCategoryModel("categoria", $item["id_categoria"]);
                
                echo'<tr>
				<td>'.$item["id"].'</td>
				<td>'.$item["codigo_producto"].'</td>
				<td>'.$item["nombre"].'</td>
				<td>'.$item["descripcion"].'</td>
				<td>'.$item["date_added"].'</td>
				<td>'.$item["precio_producto"].'</td>
				<td>'.$item["precio_compra"].'</td>
				<td>'.$item["utilidad"].'</td>
				<td>'.$item["cantidad_stock"].'</td>
				<td>'.$categoria["nombre_categoria"].'</td>
				<td><a href="index.php?action=stock-historial&idProducto='.$item["id"].'"><button class="btn btn-default"><i class="right fa  fa-edit"></i></button></a>
				<a href="index.php?action=borrarProducto&idProducto='.$item["id"].'" data-tip="Eliminar"><button class="btn btn-danger"><i class="right fa fa-trash"></i></button></a></td>
			</tr>';

            }
        }

        //listado de ventas
        public static function salesListController(){
            $ventas = DatosProd::salesListModel("ventas");
            if(!empty($ventas)){

                foreach ($ventas as $row => $item) {

                    echo "<tr>";
                    echo "<td>".$item['id']."</td>";
                    echo "<td>".$item['fecha']."</td>";
                    echo "<td>".$item['productos_vendidos']."</td>";
                    echo "<td>".$item['cantidad']."</td>";
                    echo "<td>".$item['total']."</td>";
                    echo "<td>".$item['cliente']."</td>";
                    echo "<td>"."<a class='btn btn-danger fa fa-trash' href='index.php?action=eliminarVenta&idVenta=".$item['id']."'></a></td>";
                    echo "</tr>";
                }


            }
        }

        //listado de compras
        public static function comprasListController(){
            $ventas = DatosProd::salesListModel("compras");
            if(!empty($ventas)){

                foreach ($ventas as $row => $item) {

                    echo "<tr>";
                    echo "<td>".$item['id']."</td>";
                    echo "<td>".$item['fecha']."</td>";
                    echo "<td>".$item['producto']."</td>";
                    echo "<td>".$item['cantidad']."</td>";
                    echo "<td>".$item['total']."</td>";
                    echo "<td>".$item['proveedor']."</td>";
                    echo "<td>"."<a class='btn btn-danger fa fa-trash' href='index.php?action=eliminarCompra&idCompra=".$item['id']."'></a></td>";
                    echo "</tr>";
                }


            }
        }

        //listado de pedidos
        public static function ordersListController(){
            $ventas = DatosProd::salesListModel("pedidos");
            if(!empty($ventas)){

                foreach ($ventas as $row => $item) {

                    echo "<tr>";
                    echo "<td>".$item['id']."</td>";
                    echo "<td>".$item['fecha']."</td>";
                    echo "<td>".$item['producto']."</td>";
                    echo "<td>".$item['cantidad']."</td>";
                    echo "<td>".$item['total']."</td>";
                    echo "<td>".$item['proveedor']."</td>";
                    echo "<td>"."<a class='btn btn-danger fa fa-trash' href='index.php?action=eliminarPedido&idPedido=".$item['id']."'></a></td>";
                    echo "</tr>";
                }


            }
        }



	}


?>