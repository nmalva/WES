<?php

session_start();
ob_start();
include_once('..\classes\class.jurisdicciones.php');


	//-----------------Campos---------------

	
		$campos[jur_id]=$_POST[jur_id];
	$campos[jur_nombre]=$_POST[jur_nombre];

	

	//-----------------Insert---------------
	function insert(){
		global $campos;
		$class_jurisdicciones= new Jurisdicciones();
		$new_id=$class_jurisdicciones->insert(
			$campos["jur_nombre"]
			);
	}
	//-----------------Update---------------
	function update(){
		global $campos;
		$class_jurisdicciones= new Jurisdicciones($campos["jur_id"]);

			$class_jurisdicciones->setJur_nombre($campos["jur_nombre"]);
			
	}
	
    function delete($jur_id){
    	$class_jurisdicciones= new Jurisdicciones();
    	$class_jurisdicciones->delete($jur_id);
    }


?>