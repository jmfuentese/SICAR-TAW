<?php
//Eliminar registro de compra

//se obtieneel id de la compra a eliminar desde la url
$idT = $_GET["idCompra"];

//se llama el modelo para eliminar la compra
//se pasan como parametros el nombre de la tabla y el id del registro
$res = DatosProd::deleteSaleModel("compras", $idT);

//Mensaje de exito en caso de que se elimine el registro
if ($res){
    echo "<script>
        swal({
          type:'success',
          title: 'Compra eliminada exitosamente!',
          showConfirmButton: false,
          timer:2500
        },
        function () {
            window.location.href = 'index.php?action=compras';
            tr.hide();
         });
    </script>";

}else{
    //mensaje de error en caso de que no se elimine el registro
    echo "<script>
        swal({
          type:'error',
          title: 'Hubo un error al eliminar la compra!',
          showConfirmButton: false,
          timer:2500
        },
        function () {
            window.location.href = 'index.php?action=compras';
            tr.hide();
         });
    </script>";

}