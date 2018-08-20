<?php

session_start();
ob_start();
include_once('../classes/class.actividades.php');
include_once('../classes/class.utiles.php');
include_once('../classes/class.bd.php');


	//-----------------Campos---------------
	$class_bd=new bd();
	
	$campos[act_id]=$_POST[act_id];
	$campos[cas_id]=$_POST[cas_id];
	$campos[tia_id]=$_POST[tia_id];
	$campos[act_estado]=$_POST[act_estado];
	$campos[usu_idemisor]=$_POST[usu_idemisor];
	$campos[usu_idresponsable]=$_POST[usu_idresponsable];
	$campos[act_comentario]=addslashes($_POST[act_comentario]);
	$campos[act_fecha]=$_POST[act_fecha];
	$campos[act_timestamp]=$_POST[act_timestamp];

	//---------------Functions--------------
	
	if ($campos["act_id"]==NULL){
	    $new_id=insert();
	    echo $new_id;
	}
	else
	    update();

	//-----------------Insert---------------
	function insert(){
		global $campos;
		$class_actividades= new Actividades();
		$class_utiles=new utiles();
		$new_id=$class_actividades->insert(
			$campos["cas_id"],
			$campos["tia_id"],
			$campos["act_estado"],
			$campos["usu_idemisor"],
			$campos["usu_idresponsable"],
			$campos["act_comentario"],
		    
			$class_utiles->fecha_php_mysql_datetime($campos["act_fecha"])
			);
	   
	   if ($campos["act_estado"]==1){
	       $class_actividades= new Actividades($new_id);
	       $class_actividades->setAct_fechacierre($class_utiles->fecha_mysql_timestamp());	
	   }
	}
	//-----------------Update---------------
	function update(){
		global $campos;
		$class_actividades= new Actividades($campos["act_id"]);
		$class_utiles= new utiles();

			$class_actividades->setTia_id($campos["tia_id"]);
			$class_actividades->setAct_estado($campos["act_estado"]);
			$class_actividades->setUsu_idresponsable($campos["usu_idresponsable"]);
			$class_actividades->setAct_comentario($campos["act_comentario"]);
			$class_actividades->setAct_fecha($class_utiles->fecha_php_mysql_datetime($campos["act_fecha"]));
			echo $class_utiles->fecha_php_mysql_datetime($campos["act_fecha"]);
			
			//if ($campos["act_estado"]==1)
			    $class_actividades->setAct_fechacierre($class_utiles->fecha_mysql_timestamp());
			
	}
	
    function delete($act_id){
    	$class_actividades= new Actividades();
    	$class_actividades->delete($act_id);
    }


?>