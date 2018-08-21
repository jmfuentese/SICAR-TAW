<?php
//Eliminar registro de pedido

//se obtiene el id del pedido a eliminar desde la url
$idT = $_GET["idPedido"];

//se llama el modelo para eliminar el pedido
//se pasan como parametros el nombre de la tabla y el id del registro a eliminar
$res = DatosProd::deleteSaleModel("pedidos", $idT);

//mensaje de exito en caso de que se elimine el registro
if ($res){
    echo "<script>
        swal({
          type:'success',
          title: 'Pedido eliminado exitosamente!',
          showConfirmButton: false,
          timer:2500
        },
        function () {
            window.location.href = 'index.php?action=pedidos';
            tr.hide();
         });
    </script>";

}else{
    //mensaje de error en caso de que no se elimine el registro
    echo "<script>
        swal({
          type:'error',
          title: 'Hubo un error al eliminar el pedido!',
          showConfirmButton: false,
          timer:2500
        },
        function () {
            window.location.href = 'index.php?action=pedidos';
            tr.hide();
         });
    </script>";

}