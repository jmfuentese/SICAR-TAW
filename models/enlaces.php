<?php 
//Clase para los enlaces del sistema
class Pages{
	//modelo para construir cada ruta
	public static function linkPagesM($link){

        //se valida el valor del parametro recibido el cual corresponde a la variable action de la url
		if($link == "ingresar" || $link == "inventario" || $link == "editarUsuario" || $link == "salir" || $link == "dashboard"
            || $link == "usuarios" || $link == "categorias" || $link == "stock-historial" || $link == "borrarProducto"
            || $link == "borrarCategoria" || $link == "borrarUsuario" || $link == "borrarTienda" || $link == "tiendas"
            || $link == "vender" || $link == "ventas" || $link == "agregarAlCarrito" || $link == "quitarDelCarrito"
            || $link == "terminarVenta" || $link == "cancelarVenta" || $link == "eliminarVenta" || $link == "eliminarCompra"
            || $link == "eliminarPedido" || $link == "compras" || $link == "pedidos"){
		    //se concatena el valor de link con la ruta a el archivo especifico
			$module =  "views/modules/".$link.".php";
		}

		//en caso especifico index
		else if($link == "index"){
			$module =  "views/modules/ingresar.php";
		}

		//en caso especifico fallo
		else if($link == "fallo"){
			$module =  "views/modules/ingresar.php";
		}

        //en caso de encontrarse un valor desconocido muestra una pagina de error 404
		else{
			$module =  "views/modules/404.html";
		}
		//se retorna la ruta completa al archivo deseado
		return $module;
	}
}