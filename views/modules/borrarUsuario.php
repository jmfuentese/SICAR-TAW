<?php

//Se obtiene el id del proveedor a eliminar via URL
$idU = $_GET["idUsuario"];

//Se llama el modelo para eliminar el usuario(proveedor)
//se pasan como parametros el nombre de la tabla y el id del proveedor a eliminar
$res = DatosProd::deleteUserModel("proveedores", $idU);

//Mensaje de exito en casod e que se elimine el proveedor
if ($res){
    echo "<script>
        swal({
          type:'success',
          title: 'Proveedor eliminado exitosamente!',
          showConfirmButton: false,
          timer:2500
        },
        function () {
            window.location.href = 'index.php?action=usuarios';
            tr.hide();
         });
    </script>";

}else{
    //Mensaje de error en caso de que no se elimine el proveedor
    echo "<script>
        swal({
          type:'error',
          title: 'Hubo un error al eliminar el proveedor!',
          showConfirmButton: false,
          timer:2500
        },
        function () {
            window.location.href = 'index.php?action=usuarios';
            tr.hide();
         });
    </script>";
}
