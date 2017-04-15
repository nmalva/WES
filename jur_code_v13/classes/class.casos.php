<?php

require_once("class.bd.php");

class Casos extends bd
{

	private $table;
	private $fields=array();

	//-----------------Mapping---------------

	function Mapping($r)
	{
	    $this->table="Casos";
	    $this->cas_id=$r["cas_id"]; // cambio
	    $this->cas_caratula=$r["cas_caratula"];
	    $this->cas_legajo=$r["cas_legajo"];
	    $this->cas_legajo1=$r["cas_legajo1"];
	    $this->esc_id=$r["esc_id"];
	    $this->juz_id=$r["juz_id"];
	    $this->jur_id=$r["jur_id"];
	    $this->cli_id=$r["cli_id"];
	    $this->mat_id=$r["mat_id"];
	    $this->cas_fecha=$r["cas_fecha"];
	    $this->cas_timestamp=$r["cas_timestamp"];
	}

	//-----------------Constructor---------------

	function __construct($id = 0)
	{
	    parent::__construct(); //cambio
	    
	    if($id>0)
			{

            $sql = "SELECT * FROM Casos WHERE cas_id = {$id}";
            $resultado=$this->ejecutar($sql);
            $r = $this->retornar_fila($resultado);
            
            $this->Mapping($r); //cambio
            	           
			}
		
	}


	//-----------------Set Methods---------------

	function setCas_id($value){
	$sql="UPDATE Casos  SET cas_id='{$value}' WHERE cas_id={$this->cas_id}";
	$this-> ejecutar($sql);
	}
	function setCas_caratula($value){
	$sql="UPDATE Casos  SET cas_caratula='{$value}' WHERE cas_id={$this->cas_id}";
	$this-> ejecutar($sql);
	}
	function setCas_legajo($value){
	$sql="UPDATE Casos  SET cas_legajo='{$value}' WHERE cas_id={$this->cas_id}";
	$this-> ejecutar($sql);
	}
	function setCas_legajo1($value){
	    $sql="UPDATE Casos  SET cas_legajo1='{$value}' WHERE cas_id={$this->cas_id}";
	    $this-> ejecutar($sql);
	}
	function setEsc_id($value){
	$sql="UPDATE Casos  SET esc_id='{$value}' WHERE cas_id={$this->cas_id}";
	$this-> ejecutar($sql);
	}
	function setJuz_id($value){
	$sql="UPDATE Casos  SET juz_id='{$value}' WHERE cas_id={$this->cas_id}";
	$this-> ejecutar($sql);
	}
	function setJur_id($value){
	$sql="UPDATE Casos  SET jur_id='{$value}' WHERE cas_id={$this->cas_id}";
	$this-> ejecutar($sql);
	}
	function setCli_id($value){
	$sql="UPDATE Casos  SET cli_id='{$value}' WHERE cas_id={$this->cas_id}";
	$this-> ejecutar($sql);
	}
	function setMat_id($value){
	$sql="UPDATE Casos  SET mat_id='{$value}' WHERE cas_id={$this->cas_id}";
	$this-> ejecutar($sql);
	}
	function setCas_fecha($value){
	$sql="UPDATE Casos  SET cas_fecha='{$value}' WHERE cas_id={$this->cas_id}";
	$this-> ejecutar($sql);
	}
	function setCas_timestamp($value){
	$sql="UPDATE Casos  SET cas_timestamp='{$value}' WHERE cas_id={$this->cas_id}";
	$this-> ejecutar($sql);
	}

	//-----------------Get Methods---------------

	function getCas_id(){return $this->cas_id;}
	function getCas_caratula(){return $this->cas_caratula;}
	function getCas_legajo(){return $this->cas_legajo;}
	function getCas_legajo1(){return $this->cas_legajo1;}
	function getEsc_id(){return $this->esc_id;}
	function getJuz_id(){return $this->juz_id;}
	function getJur_id(){return $this->jur_id;}
	function getCli_id(){return $this->cli_id;}
	function getMat_id(){return $this->mat_id;}
	function getCas_fecha(){return $this->cas_fecha;}
	function getCas_timestamp(){return $this->cas_timestamp;}


//-----------------Insert---------------
	function insert($cas_caratula,$cas_legajo,$cas_legajo1,$esc_id,$juz_id,$jur_id,$cli_id,$mat_id,$cas_fecha){
	 
	    $sql= "INSERT INTO Casos (cas_caratula, cas_legajo, cas_legajo1, esc_id, juz_id, jur_id, cli_id, mat_id, cas_fecha) 
	    VALUES ('{$cas_caratula}','{$cas_legajo}','{$cas_legajo1}','{$esc_id}','{$juz_id}','{$jur_id}','{$cli_id}','{$mat_id}','{$cas_fecha}')";
	    return($this->ejecutar($sql));
	}
	
	
//-----------------Delete---------------

	function delete($id){
	
	$sql="DELETE FROM Cosos WHERE act_id={$id}";
	$this->ejecutar($sql);
	}

//-----------------GetAll---------------

function getAll(){
		$sql = "SELECT * FROM Casos";
        $resultado=$this->ejecutar($sql);
		return $resultado;
}
}
?>