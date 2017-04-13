<?php

session_start();
ob_start();
include_once('..\classes\class.juzgados.php');


	//-----------------Campos---------------

	
		$campos[juz_id]=$_POST[juz_id];
	$campos[juz_nombre]=$_POST[juz_nombre];

	

	//-----------------Insert---------------
	function insert(){
		global $campos;
		$class_juzgados= new Juzgados();
		$new_id=$class_juzgados->insert(
			$campos["juz_nombre"]
			);
	}
	//-----------------Update---------------
	function update(){
		global $campos;
		$class_juzgados= new Juzgados($campos["juz_id"]);

			$class_juzgados->setJuz_nombre($campos["juz_nombre"]);
			
	}
	
    function delete($juz_id){
    	$class_juzgados= new Juzgados();
    	$class_juzgados->delete($juz_id);
    }


?>