<?php
include_once('class.bd.php');//configurar en este archivo la conexion a base de datos 

Class Materias 
 { 

	private $table;
	private $fields=array();

	//-----------------Mapping---------------

	function Mapping($r)
	{
		$this->table="Materias";
		$this->mat_id=$r["mat_id"];
		$this->mat_nombre=$r["mat_nombre"];
	}

	//-----------------Constructor---------------

	function __construct($id = 0)
	{
	    parent::__construct(); //cambio
		if($id>0)
			{
			
                            $sql = "SELECT * FROM Materias WHERE mat_id = {$id}";
                            $resultado=$this->ejecutar($sql);
                            $r = $this->retornar_fila($resultado);
            	           
			}
		$this->Mapping($r);
	}


	//-----------------Set Methods---------------

	function setMat_id($value){
	$sql="UPDATE Materias  SET mat_id='{$value}' WHERE mat_id={$this->mat_id}";
	$this-> ejecutar($sql);
	}
	function setMat_nombre($value){
	$sql="UPDATE Materias  SET mat_nombre='{$value}' WHERE mat_id={$this->mat_id}";
	$this-> ejecutar($sql);
	}

	//-----------------Get Methods---------------

	function getMat_id(){return $this->mat_id;}
	function getMat_nombre(){return $this->mat_nombre;}


//-----------------Insert---------------
     function insert($mat_nombre){
        $sql= "INSERT INTO Materias (mat_nombre)
        VALUES ('{$mat_nombre}')";
        return($this->ejecutar($sql));
    }
	

//-----------------Delete---------------

	function delete($id){
	
	$sql="DELETE FROM Materias WHERE mat_id={$id}";
	$this->ejecutar($sql);
	}

//-----------------GetAll---------------

function getAll(){
		$sql = "SELECT * FROM Materias";
        $resultado=$this->ejecutar($sql);
		return $resultado;
}
}
?>