<?php

session_start();
ob_start();
include_once('..\classes\class.estadocaso.php');


	//-----------------Campos---------------

	
		$campos[esc_id]=$_POST[esc_id];
	$campos[esc_nombre]=$_POST[esc_nombre];
	$campos[esc_timestamp]=$_POST[esc_timestamp];

	

	//-----------------Insert---------------
	function insert(){
		global $campos;
		$class_estadocaso= new EstadoCaso();
		$new_id=$class_estadocaso->insert(
			$campos["esc_nombre"],
			$campos["esc_timestamp"]
			);
	}
	//-----------------Update---------------
	function update(){
		global $campos;
		$class_estadocaso= new EstadoCaso($campos["esc_id"]);

			$class_estadocaso->setEsc_nombre($campos["esc_nombre"]);
			$class_estadocaso->setEsc_timestamp($campos["esc_timestamp"]);
			
	}
	
    function delete($esc_id){
    	$class_estadocaso= new EstadoCaso();
    	$class_estadocaso->delete($esc_id);
    }


?>