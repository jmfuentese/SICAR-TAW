<?php
//Eliminar registro de venta

//se obtiene el id del registro de venta a eliminar desde la url
$idT = $_GET["idVenta"];

//se llama el modelo para eliminar el registro de la venta
//se pasan como parametros el nombre de la tabla y el id del registro a eliminar
$res = DatosProd::deleteSaleModel("ventas", $idT);

//mensaje de exito en caso de que se elimine el registro de la venta
if ($res){
    echo "<script>
        swal({
          type:'success',
          title: 'Venta eliminada exitosamente!',
          showConfirmButton: false,
          timer:2500
        },
        function () {
            window.location.href = 'index.php?action=ventas';
            tr.hide();
         });
    </script>";

}else{
    //mensaje de error en caso de que no se elimine el registro de la venta
    echo "<script>
        swal({
          type:'error',
          title: 'Hubo un error al eliminar la venta!',
          showConfirmButton: false,
          timer:2500
        },
        function () {
            window.location.href = 'index.php?action=ventas';
            tr.hide();
         });
    </script>";

}