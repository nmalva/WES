<?php

require_once("class.bd.php");

class CompartirCasos extends bd
 { 

    private $table;
	private $fields=array();

	//-----------------Mapping---------------

	function Mapping($r)
	{
	   $this->table="CompartirCasos";
		$this->coc_id=$r["coc_id"];
		$this->cas_id=$r["cas_id"];
		$this->usu_id=$r["usu_id"];
		$this->coc_timestamp=$r["coc_timestamp"];
	}

 //-----------------Constructor---------------

	function __construct($id = 0)
	{
	    parent::__construct(); //cambio
	    
	    if($id>0)
			{

            $sql = "SELECT * FROM CompartirCasos WHERE coc_id = {$id}";
            $resultado=$this->ejecutar($sql);
            $r = $this->retornar_fila($resultado);
            
            $this->Mapping($r); //cambio
            	           
			}
		
	}


	//-----------------Set Methods---------------

	function setCoc_id($value){
	$sql="UPDATE CompartirCasos  SET coc_id='{$value}' WHERE coc_id={$this->coc_id}";
	$this-> ejecutar($sql);
	}
	function setCas_id($value){
	$sql="UPDATE CompartirCasos  SET cas_id='{$value}' WHERE coc_id={$this->coc_id}";
	$this-> ejecutar($sql);
	}
	function setUsu_id($value){
	$sql="UPDATE CompartirCasos  SET usu_id='{$value}' WHERE coc_id={$this->coc_id}";
	$this-> ejecutar($sql);
	}
	function setCoc_timestamp($value){
	$sql="UPDATE CompartirCasos  SET coc_timestamp='{$value}' WHERE coc_id={$this->coc_id}";
	$this-> ejecutar($sql);
	}

	//-----------------Get Methods---------------

	function getCoc_id(){return $this->coc_id;}
	function getCas_id(){return $this->cas_id;}
	function getUsu_id(){return $this->usu_id;}
	function getCoc_timestamp(){return $this->coc_timestamp;}

//-----------------Insert---------------

 function insert($cas_id,$usu_id){
        $sql= "INSERT INTO CompartirCasos (cas_id, usu_id)
        VALUES ('{$cas_id}','{$usu_id}')";
        return($this->ejecutar($sql));	
    }
//-----------------Delete---------------

	function delete($id){
	
	$sql="DELETE FROM CompartirCasos WHERE cas_id={$id}";
	$this->ejecutar($sql);
	}
	
	

//-----------------GetAll---------------

function getAll(){
		$sql = "SELECT * FROM CompartirCasos";
        $resultado=$this->ejecutar($sql);
		return $resultado;
}
}

