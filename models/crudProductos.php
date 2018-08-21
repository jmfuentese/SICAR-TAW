<?php
    //Se incluye el archivo de conexion a la BD
	require_once("conexion.php");

	//Clase que contiene los modelos, hereda la conexion
	class DatosProd extends Conexion{

	    //modelo para registrar producto nuevo
		public static function productRegistrationModel($table,$datos){
		    //se prepara el sentencia sql
			$statement = Conexion::conectar()->prepare("INSERT INTO $table(nombre,descripcion,precio_compra,precio_venta,precio) VALUES (:nombre,:descripcion,:precioC,:precioV,:precioP)");
			//se parametrizan las variables por seguridad
			$statement->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
			$statement->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);
			$statement->bindParam(":precioC",$datos["precio_compra"],PDO::PARAM_INT);
			$statement->bindParam(":precioV",$datos["precio_venta"],PDO::PARAM_INT);
			$statement->bindParam(":precioP",$datos["precio"],PDO::PARAM_INT);
			if($statement->execute()){
				return "1";
			}else{
				return "0";
			}
			//$statement->close();
		}


        //Se obtiene el total de stock de todos los productos registrados
		public static function getTotalProductos($tabla){
            $statement = Conexion::conectar()->prepare("SELECT SUM(cantidad_stock) AS total FROM $tabla");
            $statement->execute();
            return $statement->fetch();
        }

        //se obtiene el total de registros en una tabla
        public static function getTotalRegistros($tabla){
            $statement = Conexion::conectar()->prepare("SELECT COUNT(*) AS total FROM $tabla");
            $statement->execute();
            return $statement->fetch();
        }

        //modelo para registrar nuevo proveedor
		public static function registerUserModel($table, $datos){
		    //se prepara la sentencia sql
            $statement = Conexion::conectar()->prepare(
                "INSERT INTO $table(first_name,last_name,user_email,date_added, rfc, curp) 
                                VALUES (:nombre,:apellido,:email,:date_add, :rfc, :curp)");
            //se parametrizan las variables por seguridad
            $statement->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
            $statement->bindParam(":apellido",$datos["apellido"],PDO::PARAM_STR);
            $statement->bindParam(":email",$datos["email"],PDO::PARAM_INT);
            $statement->bindParam(":date_add",$datos["date"],PDO::PARAM_INT);
            $statement->bindParam(":rfc",$datos["rfc"],PDO::PARAM_STR);
            $statement->bindParam(":curp",$datos["curp"],PDO::PARAM_STR);
            //se ejecuta la sentencia y se valida
            if($statement->execute()){
                return true;
            }else{
                return false;
            }
        }

        //modelo para registrar una categoria nueva
        public static function registerCategoryModel($table, $datos){
		    //se prepara la sentencia sql
            $statement = Conexion::conectar()->prepare(
                "INSERT INTO $table(nombre_categoria,descripcion_categoria,date_added) 
                                VALUES (:nombre,:descripcion,:date_add)");
            //se parametrizan las variables por seguridad
            $statement->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
            $statement->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);
            $statement->bindParam(":date_add",$datos["date"],PDO::PARAM_INT);
            //se ejecuta la sentencia y se valida
            if($statement->execute()){
                return true;
            }else{
                return false;
            }
        }


        //modelo para registrar una nueva venta
        public static function registerSaleModel($table, $datos){
		    //se prepara la sentencia sql
            $statement = Conexion::conectar()->prepare(
                "INSERT INTO $table(fecha,productos_vendidos,cantidad, total, cliente) 
                            VALUES (:fecha,:producto,:cantidad, :total, :cliente)");
            //se parametrizan las variables por seguridad
            $statement->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
            $statement->bindParam(":producto",$datos["producto"],PDO::PARAM_STR);
            $statement->bindParam(":cantidad",$datos["cantidad"],PDO::PARAM_INT);
            $statement->bindParam(":total",$datos["total"],PDO::PARAM_INT);
            $statement->bindParam(":cliente",$datos["cliente"],PDO::PARAM_STR);
            //se ejecuta la sentencia y se valida
            if($statement->execute()){
                return true;
            }else{
                return false;
            }
        }

        //modelo para registrar una nueva compra
        public static function registerCompraModel($table, $datos){
		    //se prepara la sentencia sql
            $statement = Conexion::conectar()->prepare(
                "INSERT INTO $table(fecha,producto,cantidad, total, proveedor) 
                            VALUES (:fecha,:producto,:cantidad, :total, :proveedor)");
            //se parametrizan las variables por seguridad
            $statement->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
            $statement->bindParam(":producto",$datos["producto"],PDO::PARAM_STR);
            $statement->bindParam(":cantidad",$datos["cantidad"],PDO::PARAM_INT);
            $statement->bindParam(":total",$datos["total"],PDO::PARAM_INT);
            $statement->bindParam(":proveedor",$datos["proveedor"],PDO::PARAM_STR);
            //se ejecuta la sentencia y se valida
            if($statement->execute()){
                return true;
            }else{
                return false;
            }
        }

        //modelo para registrar nuevo producto
        public static function registerProductModel($table, $datos){
		    //se prepara la sentencia sql
            $statement = Conexion::conectar()->prepare(
                "INSERT INTO $table(codigo_producto, nombre, descripcion, date_added, precio_producto, precio_compra,
                              utilidad, cantidad_stock, id_categoria) 
                                VALUES (:codigo, :nombre, :descripcion, :date_add, :precio, :precio_compra, :utilidad, 
                                            :stock, :categoria)");
            //se parametrizan las variables por seguridad
            $statement->bindParam(":codigo",$datos["codigo"],PDO::PARAM_STR);
            $statement->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
            $statement->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);
            $statement->bindParam(":date_add",$datos["date"],PDO::PARAM_INT);
            $statement->bindParam(":precio",$datos["precio"],PDO::PARAM_INT);
            $statement->bindParam(":precio_compra",$datos["precio_compra"],PDO::PARAM_INT);
            $statement->bindParam(":utilidad",$datos["utilidad"],PDO::PARAM_INT);
            $statement->bindParam(":stock",$datos["stock"],PDO::PARAM_INT);
            $statement->bindParam(":categoria",$datos["categoria"],PDO::PARAM_INT);
            //se ejecuta la sentencia y se valida
            if($statement->execute()){
                return true;
            }else{
                return false;
            }
        }

        //modelo para eliminar el registro de un producto
        public static function deleteProductModel($table, $idP){
		    //se prepara la sentencia sql
		    $statement = Conexion::conectar()->prepare("DELETE FROM $table WHERE id = :id");
		    //se parametriza la variables
            $statement->bindParam(":id",$idP,PDO::PARAM_STR);
            //se ejecuta la sentencia y se valida
            if($statement->execute()){
                return true;
            }else{
                return false;
            }
        }

        //modelo para eliminar una categoria
        public static function deleteCategoryModel($table, $idC){
		    //se prepara la sentencia sql
            $statement = Conexion::conectar()->prepare("DELETE FROM $table WHERE id_categoria = :id");
            //se parametriza la variable
            $statement->bindParam(":id",$idC,PDO::PARAM_STR);
            //se ejecuta la sentencia
            if($statement->execute()){
                return true;
            }else{
                return false;
            }
        }

        //modelo para eliminar una venta
        public static function deleteSaleModel($table, $idV){
		    //se prepara la sentencia sql
            $statement = Conexion::conectar()->prepare("DELETE FROM $table WHERE id = :id");
            //se parametriza la variable
            $statement->bindParam(":id",$idV,PDO::PARAM_STR);
            //se ejecuta la sentencia y se valida
            if($statement->execute()){
                return true;
            }else{
                return false;
            }
        }

        //modelo para eliminar un proveedor
        public static function deleteUserModel($table, $idU){
		    //se prepara la sentencia sql
            $statement = Conexion::conectar()->prepare("DELETE FROM $table WHERE id = :id");
            //se parametriza la variable
            $statement->bindParam(":id",$idU,PDO::PARAM_STR);
            //se ejecuta la sentencia y se valida
            if($statement->execute()){
                return true;
            }else{
                return false;
            }
        }

        //modelo para registrar un movimiento en el historial de ajuste de inventario
        public static function historialAdd($tabla, $idP, $nota, $usr, $date, $stock){
		    //se prepara la sentencia sql
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_producto, nota, usuario, fecha, cantidad) VALUES 
                                                              (:idP, :nota, :usuario, :fecha, :cantidad)");
            //se parametrizan las variables
            $stmt->bindParam(":idP",$idP,PDO::PARAM_INT);
            $stmt->bindParam(":nota",$nota,PDO::PARAM_STR);
            $stmt->bindParam(":usuario",$usr,PDO::PARAM_STR);
            $stmt->bindParam(":fecha",$date,PDO::PARAM_STR);
            $stmt->bindParam(":cantidad",$stock,PDO::PARAM_INT);
            //se ejecuta la sentencia
            $stmt->execute();
        }

        //modelo para agregar stock al existente de un producto
        public static function addStockModel($table, $stock, $idP){
		    //se obtiene el stock actual del producto
		    $currentStock = self::getStockModel($idP);
		    //se calcula el nuevo stock sumando el actual con el que se esta insertando
		    $newStock = (int)$stock + (int)$currentStock["cantidad_stock"];
            //se prepara la sentencia sql
		    $statement = Conexion::conectar()->prepare("UPDATE $table SET cantidad_stock = :newStock WHERE id = :id");
		    //se parametrizan las variables
            $statement->bindParam(":id",$idP,PDO::PARAM_INT);
            $statement->bindParam(":newStock",$newStock,PDO::PARAM_STR);
            //se ejecuta la sentencia y se valida
            if($statement->execute()){
                return true;
            }else{
                return false;
            }
        }

        //modelo para eliminar stock
        public static function delStockModel($table, $stock, $idP){
            //se obtiene el stock actual
            $currentStock = self::getStockModel($idP);
            //se calcula el nuevo stock restando el actual menos el que se esta ingresando
            $newStock = (int)$currentStock["cantidad_stock"] - (int)$stock;
            //se prepara la sentencia sql
            $statement = Conexion::conectar()->prepare("UPDATE $table SET cantidad_stock = :newStock WHERE id = :id");
            $statement->bindParam(":id",$idP,PDO::PARAM_INT);
            $statement->bindParam(":newStock",$newStock,PDO::PARAM_STR);
            //se ejecuta la sentencia y se valida
            if($statement->execute()){
                return true;
            }else{
                return false;
            }
        }

        //modelo para obtener el stock de un producto
        public static function getStockModel($idP){
            $statement = Conexion::conectar()->prepare("SELECT * FROM productos WHERE id = :id");
            $statement->bindParam(":id",$idP,PDO::PARAM_INT);
            $statement->execute();
            #fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
            return $statement->fetch();
        }

        //modelo para realizar la validacion de acceso al sistema
        public static function loginModel($table, $datos){
		    //se obtiene contraseña y usuario para validarse despues en el controlador con los que se ingresaron
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE usuario = :user AND password = :pass");
            $statement->bindParam(":user", $datos["usuario"],PDO::PARAM_STR);
            $statement->bindParam(":pass", $datos["password"],PDO::PARAM_STR);
            $statement->execute();
            #fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
            return $statement->fetch();
            //$statement->close();
        }

        //listado de usuarios (proveedores)
        public static function userListModel($table){
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table");
            $statement->execute();
            return $statement->fetchAll();
        }

        //listado de categorias
        public static function categoryListModel($table){
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table");
            $statement->execute();
            return $statement->fetchAll();
        }

        //listado de productos
        public static function productsListModel($table){
		    $statement = Conexion::conectar()->prepare("SELECT * FROM $table");
            $statement->execute();
            return $statement->fetchAll();
        }

        //listado del historial de movimientos por un producto en especifico
        public static function historyListModel($table, $idP){
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id_producto = :idP");
            $statement->bindParam(":idP", $idP, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll();
        }

        //obtener informacion de un producto por ID
        public static function getProductModel($table, $idP){
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id = :id");
            $statement->bindParam(":id", $idP, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch();
        }

        //obtener listado de todos los productos
        public static function getProductsForSale($table, $idT){
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table");
            $statement->execute();
            return $statement->fetchAll();
        }

        //obtener informacion de un producto por su codigo
        public static function getProductByCodeModel($table, $code){
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE codigo_producto = :code");
            $statement->bindParam(":code", $code, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch();
        }

        //obtener informacion de un producto por su nombre
        public static function getProductByNameModel($table, $name){
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE nombre = :nom");
            $statement->bindParam(":nom", $name, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch();
        }

        //obtener informacion de todos los usuarios
        public static function getUserModel($table){
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table");
            $statement->execute();
            return $statement->fetch();
        }

        
        public static function getUserByNameModel($table, $name){
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE first_name = :nombre");
            $statement->bindParam(":nombre", $name, PDO::PARAM_STR);
            $statement->execute();

            return $statement->fetch();
        }

        public static function getUserByIdModel($table, $usr){
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id = :id");
            $statement->bindParam(":id", $usr, PDO::PARAM_STR);
            $statement->execute();

            return $statement->fetch();
        }

        public static function getCategoryModel($table, $id){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id_categoria = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch();
        }

        public static function getCategoryByNameModel($table, $nombre){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE nombre_categoria = :nombre");
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch();
        }

        public static function updateUserModel($table, $datos, $usr){
            $stmt = Conexion::conectar()->prepare("UPDATE $table SET first_name = :nombre, last_name = :apellido, 
                                                  user_email = :email, rfc = :rfc, curp = :curp WHERE id = :id");

            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            $stmt->bindParam(":rfc", $datos["rfc"], PDO::PARAM_STR);
            $stmt->bindParam(":curp", $datos["curp"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $usr, PDO::PARAM_INT);

            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public static function salesListModel($table){
            $statement = Conexion::conectar()->prepare("SELECT * FROM $table");
            $statement->execute();

            return $statement->fetchAll();
        }

	}
?>