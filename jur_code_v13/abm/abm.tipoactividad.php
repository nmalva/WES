<?php

session_start();
ob_start();
include_once('..\classes\class.tipoactividad.php');


	//-----------------Campos---------------

	
		$campos[tia_id]=$_POST[tia_id];
	$campos[tia_nombre]=$_POST[tia_nombre];
	$campos[tia_diaprevio]=$_POST[tia_diaprevio];
	$campos[tia_diapos]=$_POST[tia_diapos];
	$campos[tia_popup]=$_POST[tia_popup];
	$campos[tia_verificar]=$_POST[tia_verificar];
	$campos[tia_timestamp]=$_POST[tia_timestamp];

	

	//-----------------Insert---------------
	function insert(){
		global $campos;
		$class_tipoactividad= new TipoActividad();
		$new_id=$class_tipoactividad->insert(
			$campos["tia_nombre"],
			$campos["tia_diaprevio"],
			$campos["tia_diapos"],
			$campos["tia_popup"],
		    $campos["tia_verificar"],
			$campos["tia_timestamp"]
			);
	}
	//-----------------Update---------------
	function update(){
		global $campos;
		$class_tipoactividad= new TipoActividad($campos["tia_id"]);

			$class_tipoactividad->setTia_nombre($campos["tia_nombre"]);
			$class_tipoactividad->setTia_diaprevio($campos["tia_diaprevio"]);
			$class_tipoactividad->setTia_diapos($campos["tia_diapos"]);
			$class_tipoactividad->setTia_popup($campos["tia_popup"]);
			$class_tipoactividad->setTia_popup($campos["tia_verificar"]);
			$class_tipoactividad->setTia_timestamp($campos["tia_timestamp"]);
			
	}
	
    function delete($tia_id){
    	$class_tipoactividad= new TipoActividad();
    	$class_tipoactividad->delete($tia_id);
    }


?>