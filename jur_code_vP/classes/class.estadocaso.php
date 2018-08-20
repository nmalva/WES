<?php
include_once('class.bd.php');//configurar en este archivo la conexion a base de datos 

Class EstadoCaso 
 { 

	private $table;
	private $fields=array();

	//-----------------Mapping---------------

	function Mapping($r)
	{
		$this->table="EstadoCaso";
		$this->esc_id=$r["esc_id"];
		$this->esc_nombre=$r["esc_nombre"];
		$this->esc_timestamp=$r["esc_timestamp"];
	}

	//-----------------Constructor---------------

	function __construct($id = 0)
	{
	    parent::__construct(); //cambio
		if($id>0)
			{
			
                            $sql = "SELECT * FROM EstadoCaso WHERE esc_id = {$id}";
                            $resultado=$this->ejecutar($sql);
                            $r = $this->retornar_fila($resultado);
            	           
			}
		$this->Mapping($r);
	}


	//-----------------Set Methods---------------

	function setEsc_id($value){
	$sql="UPDATE EstadoCaso  SET esc_id='{$value}' WHERE esc_id={$this->esc_id}";
	$this-> ejecutar($sql);
	}
	function setEsc_nombre($value){
	$sql="UPDATE EstadoCaso  SET esc_nombre='{$value}' WHERE esc_id={$this->esc_id}";
	$this-> ejecutar($sql);
	}
	function setEsc_timestamp($value){
	$sql="UPDATE EstadoCaso  SET esc_timestamp='{$value}' WHERE esc_id={$this->esc_id}";
	$this-> ejecutar($sql);
	}

	//-----------------Get Methods---------------

	function getEsc_id(){return $this->esc_id;}
	function getEsc_nombre(){return $this->esc_nombre;}
	function getEsc_timestamp(){return $this->esc_timestamp;}


//-----------------Insert---------------

 function insert($esc_nombre,$esc_timestamp){
        $sql= "INSERT INTO EstadoCaso (esc_nombre,esc_timestamp)
         VALUES ('{$esc_nombre}','{$esc_timestamp}')";
        return($this->ejecutar($sql));
}
	
//-----------------Delete---------------

	function delete($id){
	
	$sql="DELETE FROM EstadoCaso WHERE esc_id={$id}";
	$this->ejecutar($sql);
	}

//-----------------GetAll---------------

function getAll(){
		$sql = "SELECT * FROM EstadoCaso";
        $resultado=$this->ejecutar($sql);
		return $resultado;
}
}
?>