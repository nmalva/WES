<?php
include_once('class.bd.php');//configurar en este archivo la conexion a base de datos 

Class Jurisdicciones 
 { 

	private $table;
	private $fields=array();

	//-----------------Mapping---------------

	function Mapping($r)
	{
		$this->table="Jurisdicciones";
		$this->jur_id=$r["jur_id"];
		$this->jur_nombre=$r["jur_nombre"];
	}

	//-----------------Constructor---------------

	function __construct($id = 0)
	{
	    parent::__construct(); //cambio
		if($id>0)
			{
			
                            $sql = "SELECT * FROM Jurisdicciones WHERE jur_id = {$id}";
                            $resultado=$this->ejecutar($sql);
                            $r = $this->retornar_fila($resultado);
            	           
			}
		$this->Mapping($r);
	}


	//-----------------Set Methods---------------

	function setJur_id($value){
	$sql="UPDATE Jurisdicciones  SET jur_id='{$value}' WHERE jur_id={$this->jur_id}";
	$this-> ejecutar($sql);
	}
	function setJur_nombre($value){
	$sql="UPDATE Jurisdicciones  SET jur_nombre='{$value}' WHERE jur_id={$this->jur_id}";
	$this-> ejecutar($sql);
	}

	//-----------------Get Methods---------------

	function getJur_id(){return $this->jur_id;}
	function getJur_nombre(){return $this->jur_nombre;}


//-----------------Insert---------------

 function insert($jur_nombre){
        $sql= "INSERT INTO Jurisdicciones (jur_nombre)
         VALUES ('{$jur_nombre}')";
        return($this->ejecutar($sql));
}
	
//-----------------Delete---------------

	function delete($id){
	
	$sql="DELETE FROM Juridiscciones WHERE jur_id={$id}";
	$this->ejecutar($sql);
	}

//-----------------GetAll---------------

function getAll(){
		$sql = "SELECT * FROM Jurisdicciones";
        $resultado=$this->ejecutar($sql);
		return $resultado;
}
}
?>