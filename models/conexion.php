<?php
//Clase para la conexion a la base de datos
class Conexion{
	//modelo para conectar
	public static function conectar(){
		//se prepara el link con nombre de host, nombre de la base de datos, usuario y contraseña de la base de datos
		$link = new PDO("mysql:host=localhost;dbname=sicar","root","SANCHEZ55");//Modificar contraseña, dbname y host en caso de ser necesario por los datos del servicio local
        return $link;
	}
}
