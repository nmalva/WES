<?php

session_start();
ob_start();
include_once('..\classes\class.materias.php');


	//-----------------Campos---------------

	
		$campos[mat_id]=$_POST[mat_id];
	$campos[mat_nombre]=$_POST[mat_nombre];

	

	//-----------------Insert---------------
	function insert(){
		global $campos;
		$class_materias= new Materias();
		$new_id=$class_materias->insert(
			$campos["mat_nombre"]
			);
	}
	//-----------------Update---------------
	function update(){
		global $campos;
		$class_materias= new Materias($campos["mat_id"]);

			$class_materias->setMat_nombre($campos["mat_nombre"]);
			
	}
	
    function delete($mat_id){
    	$class_materias= new Materias();
    	$class_materias->delete($mat_id);
    }


?>