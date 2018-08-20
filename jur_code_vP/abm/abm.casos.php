<?php
session_start();
ob_start();
include_once('../classes/class.casos.php');
include_once('../classes/class.compartircasos.php');
include_once('../classes/class.bd.php');
include_once('../classes/class.utiles.php');

$session_usu_id=$_SESSION["usu_id"];

	//-----------------Campos---------------
	
	
	$campos[cas_id]=$_POST[cas_id];
	$campos[cas_caratula]=$_POST[cas_caratula];
	$campos[cas_legajo]=$_POST[cas_legajo];
	$campos[cas_legajo1]=$_POST[cas_legajo1];
	$campos[esc_id]=$_POST[esc_id];
	$campos[juz_id]=$_POST[juz_id];
	$campos[jur_id]=$_POST[jur_id];
	$campos[cli_id]=$_POST[cli_id];
	$campos[mat_id]=$_POST[mat_id];
	$campos[cas_fecha]=$_POST[cas_fecha];
	$campos[cas_timestamp]=$_POST[cas_timestamp];

	//---------------Functions--------------
	
	if ($campos["cas_id"]==NULL){
	   $new_id=insert();  
	   insert_compartir_casos($new_id, $session_usu_id);
	   echo $new_id;
	}
	else 
	    update();

	//-----------------Insert---------------
	function insert(){
		global $campos;
		$class_utiles=new utiles();
		$class_casos= new Casos();
		$new_id=$class_casos->insert(
			$campos["cas_caratula"],
			$campos["cas_legajo"],
		    $campos["cas_legajo1"],
			$campos["esc_id"],
			$campos["juz_id"],
			$campos["jur_id"],
			$campos["cli_id"],
			$campos["mat_id"],
			$class_utiles->fecha_php_mysql($campos["cas_fecha"])
			);
		return ($new_id);
	}
	//-----------------Update---------------
	function update(){
		global $campos;
		    $class_casos= new Casos($campos["cas_id"]);
		    $class_utiles= new utiles();
			$class_casos->setCas_caratula($campos["cas_caratula"]);
			$class_casos->setCas_legajo($campos["cas_legajo"]);
			$class_casos->setCas_legajo1($campos["cas_legajo1"]);
			$class_casos->setEsc_id($campos["esc_id"]);
			$class_casos->setJuz_id($campos["juz_id"]);
			$class_casos->setJur_id($campos["jur_id"]);
			$class_casos->setCli_id($campos["cli_id"]);
			$class_casos->setMat_id($campos["mat_id"]);
			$class_casos->setCas_fecha($class_utiles->fecha_php_mysql($campos["cas_fecha"]));
		
			
	}
	
    function delete($cas_id){
    	$class_casos= new casos();
    	$class_casos->delete($cas_id);
    }
    
    function insert_compartir_casos($new_id, $session_usu_id){
        global $campos;
        $class_compartircasos= new CompartirCasos();
        $class_compartircasos->insert($new_id, $session_usu_id);
    }

?>