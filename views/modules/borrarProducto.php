<?php

//Se obtiene el id del producto a eliminar via URL
$idP = $_GET["idProducto"];

//Se llama el modelo para eliminar el producto
//se pasan como parametros el nombre de la tabla y el id del producto a eliminar
$res = DatosProd::deleteProductModel("productos", $idP);

//mensaje de exito en caso de que se elimine el producto correctamente
if ($res){
    echo "<script>
        swal({
          type:'success',
          title: 'Producto eliminado exitosamente!',
          showConfirmButton: false,
          timer:2500
        },
        function () {
            window.location.href = 'index.php?action=inventario';
            tr.hide();
         });
    </script>";
}else{
    //Mensaje de error en caso de que no se elimine el producto
    echo "<script>
        swal({
          type:'error',
          title: 'Hubo un error al eliminar el producto!',
          showConfirmButton: false,
          timer:2500
        },
        function () {
            window.location.href = 'index.php?action=inventario';
            tr.hide();
         });
    </script>";
}

