<?php
	//Se re-inicializan las variables de sesion
    $_SESSION["validar"] = false;
    $_SESSION["usuario"] = "";
    $_SESSION["password"] = "";
    $_SESSION["tienda"] = "";
    //despues de vaciar las variables se redirige a la vista de ingreso al sistema
    echo "<script>window.location.href='index.php?action=ingresar'</script>";
    exit();