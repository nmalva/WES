<?php

session_start();
ob_start();
include_once('../classes/class.compartircasos.php');

$usu_id = $_POST["selected"];
$length = $_POST["length"];
$cas_id = $_POST["cas_id"];

delete_all($cas_id);
update_select($cas_id, $usu_id, $length);


	//-----------------Campos---------------

	
	$campos[coc_id]=$_POST[coc_id];
	$campos[cas_id]=$_POST[cas_id];
	$campos[usu_id]=$_POST[usu_id];
	$campos[coc_timestamp]=$_POST[coc_timestamp];

	

	//----Update Fields Select----//
	
	function delete_all($cas_id){
	    $class_compartircasos= new CompartirCasos();
	    $class_compartircasos->delete($cas_id);
	}
	
	
	
	function update_select($cas_id, $usu_id, $length){
	
	    $class_compartircasos= new CompartirCasos();
	
	    for ($i=0; $i<$length; $i++){
	        $class_compartircasos->insert($cas_id, $usu_id[$i]);
	    }
	}
	
	
	//-----------------Insert---------------
	function insert(){
		global $campos;
		$class_compartircasos= new CompartirCasos();
		$new_id=$class_compartircasos->insert(
			$campos["cas_id"],
			$campos["usu_id"],
			$campos["coc_timestamp"]
			);
	}
	//-----------------Update---------------
	function update(){
		global $campos;
		$class_compartircasos= new CompartirCasos($campos["coc_id"]);

			$class_compartircasos->setCas_id($campos["cas_id"]);
			$class_compartircasos->setUsu_id($campos["usu_id"]);
			$class_compartircasos->setCoc_timestamp($campos["coc_timestamp"]);
			
	}
	
    function delete($coc_id){
    	$class_compartircasos= new Compartircasos();
    	$class_compartircasos->delete($coc_id);
    }


?>