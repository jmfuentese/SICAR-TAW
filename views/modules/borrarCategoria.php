<?php

//Se obtiene el id de de la categoria a eliminar via URL
$idC = $_GET["idCategoria"];

//se llama el modelo para eliminar la categoria
//se pasa como parametro el nombre de la tabla y el id de la categoria a eliminar
$res = DatosProd::deleteCategoryModel("categoria", $idC);

//Mensaje de exito en caso de que se elimine el registro
if ($res){
    //sweetalert exitoso
    echo "<script>
        swal({
          type:'success',
          title: 'Categoria eliminada exitosamente!',
          showConfirmButton: false,
          timer:2500
        },
        function () {
            window.location.href = 'index.php?action=categorias';
            tr.hide();
         });
    </script>";

}else{
    //Mensaje de error en caso de que no se efectue el cambio
    //puede deberse a errores de conexion con la base de datos
    echo "<script>
        swal({
          type:'error',
          title: 'Hubo un error al eliminar la categoria!',
          showConfirmButton: false,
          timer:2500
        },
        function () {
            window.location.href = 'index.php?action=categorias';
            tr.hide();
         });
    </script>";
}
