<?php

session_start();
ob_start();
include_once('..\classes\class.usuarios.php');


	//-----------------Campos---------------

	
	$campos[usu_id]=$_POST[usu_id];
	$campos[usu_nombre]=$_POST[usu_nombre];
	$campos[usu_apellido]=$_POST[usu_apellido];
	$campos[usu_usuario]=$_POST[usu_usuario];
	$campos[usu_clave]=$_POST[usu_clave];
	$campos[usu_perfil]=$_POST[usu_perfil];
	$campos[usu_timestamp]=$_POST[usu_timestamp];

	

	//-----------------Insert---------------
	function insert(){
		global $campos;
		$class_usuarios= new Usuarios();
		$new_id=$class_usuarios->insert(
			$campos["usu_nombre"],
			$campos["usu_apellido"],
			$campos["usu_usuario"],
			$campos["usu_clave"],
			$campos["usu_perfil"],
			$campos["usu_timestamp"]
			);
	}
	//-----------------Update---------------
	function update(){
		global $campos;
		$class_usuarios= new Usuarios($campos["usu_id"]);

			$class_usuarios->setUsu_nombre($campos["usu_nombre"]);
			$class_usuarios->setUsu_apellido($campos["usu_apellido"]);
			$class_usuarios->setUsu_usuario($campos["usu_usuario"]);
			$class_usuarios->setUsu_clave($campos["usu_clave"]);
			$class_usuarios->setUsu_perfil($campos["usu_perfil"]);
			$class_usuarios->setUsu_timestamp($campos["usu_timestamp"]);
			
	}
	
    function delete($usu_id){
    	$class_usuarios= new Usuarios();
    	$class_usuarios->delete($usu_id);
    }


?>