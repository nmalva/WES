<?php
include_once('class.bd.php');//configurar en este archivo la conexion a base de datos 

Class TipoActividad extends bd
 { 

	private $table;
	private $fields=array();

	//-----------------Mapping---------------

	function Mapping($r)
	{
		$this->table="TipoActividad";
		$this->tia_id=$r["tia_id"];
		$this->tia_nombre=$r["tia_nombre"];
		$this->tia_diaprevio=$r["tia_diaprevio"];
		$this->tia_diapos=$r["tia_diapos"];
		$this->tia_popup=$r["tia_popup"];
		$this->tia_verificar=$r["tia_verificar"];
		$this->tia_timestamp=$r["tia_timestamp"];
	}

	//-----------------Constructor---------------

	function __construct($id = 0)
	{
	    parent::__construct(); //cambio
		if($id>0)
			{
			
                            $sql = "SELECT * FROM TipoActividad WHERE tia_id = {$id}";
                            $resultado=$this->ejecutar($sql);
                            $r = $this->retornar_fila($resultado);
            	           
			}
		$this->Mapping($r);
	}


	//-----------------Set Methods---------------

	function setTia_id($value){
	$sql="UPDATE tiaoActividad  SET tia_id='{$value}' WHERE tia_id={$this->tia_id}";
	$this-> ejecutar($sql);
	}
	function setTia_nombre($value){
	$sql="UPDATE tiaoActividad  SET tia_nombre='{$value}' WHERE tia_id={$this->tia_id}";
	$this-> ejecutar($sql);
	}
	function setTia_diaprevio($value){
	$sql="UPDATE tiaoActividad  SET tia_diaprevio='{$value}' WHERE tia_id={$this->tia_id}";
	$this-> ejecutar($sql);
	}
	function setTia_diapos($value){
	$sql="UPDATE tiaoActividad  SET tia_diapos='{$value}' WHERE tia_id={$this->tia_id}";
	$this-> ejecutar($sql);
	}
	function setTia_popup($value){
	$sql="UPDATE tiaoActividad  SET tia_popup='{$value}' WHERE tia_id={$this->tia_id}";
	$this-> ejecutar($sql);
	}
	function setTia_verificar($value){
	    $sql="UPDATE tiaoActividad  SET tia_verificar='{$value}' WHERE tia_id={$this->tia_id}";
	    $this-> ejecutar($sql);
	}
	function setTia_timestamp($value){
	$sql="UPDATE tiaoActividad  SET tia_timestamp='{$value}' WHERE tia_id={$this->tia_id}";
	$this-> ejecutar($sql);
	}

	//-----------------Get Methods---------------

	function getTia_id(){return $this->tia_id;}
	function getTia_nombre(){return $this->tia_nombre;}
	function getTia_diaprevio(){return $this->tia_diaprevio;}
	function getTia_diapos(){return $this->tia_diapos;}
	function getTia_popup(){return $this->tia_popup;}
	function getTia_verificar(){return $this->tia_verificar;}
	function getTia_timestamp(){return $this->tia_timestamp;}


//-----------------Insert---------------
	function insert($tia_nombre,$tia_diaprevio,$tia_diapos,$tia_popup,$tia_verificar,$tia_timestamp){
	    $sql= "INSERT INTO TipoActividad (tia_nombre,tia_diaprevio,tia_diapos,tia_popup,tia_verificar,tia_timestamp)
	    VALUES ('{$tia_nombre}','{$tia_diaprevio}','{$tia_diapos}','{$tia_popup}','{$tia_verificar}','{$tia_timestamp}')";
	    return($this->ejecutar($sql));
	}
	
//-----------------Delete---------------

	function delete($id){
	
	$sql="DELETE FROM TipoActividad WHERE tia_id={$id}";
	$this->ejecutar($sql);
	}

//-----------------GetAll---------------

function getAll(){
		$sql = "SELECT * FROM TipoActividad";
        $resultado=$this->ejecutar($sql);
		return $resultado;
}
}
?>