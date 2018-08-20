<?php
include_once('class.bd.php');//configurar en este archivo la conexion a base de datos 

Class Juzgados 
 { 

	private $table;
	private $fields=array();

	//-----------------Mapping---------------

	function Mapping($r)
	{
		$this->table="Juzgados";
		$this->juz_id=$r["juz_id"];
		$this->juz_nombre=$r["juz_nombre"];
	}

	//-----------------Constructor---------------

	function __construct($id = 0)
	{
	    parent::__construct(); //cambio
		if($id>0)
			{
			
                            $sql = "SELECT * FROM Juzgados WHERE juz_id = {$id}";
                            $resultado=$this->ejecutar($sql);
                            $r = $this->retornar_fila($resultado);
            	           
			}
		$this->Mapping($r);
	}


	//-----------------Set Methods---------------

	function setJuz_id($value){
	$sql="UPDATE Juzgados  SET juz_id='{$value}' WHERE juz_id={$this->juz_id}";
	$this-> ejecutar($sql);
	}
	function setJuz_nombre($value){
	$sql="UPDATE Juzgados  SET juz_nombre='{$value}' WHERE juz_id={$this->juz_id}";
	$this-> ejecutar($sql);
	}

	//-----------------Get Methods---------------

	function getJuz_id(){return $this->juz_id;}
	function getJuz_nombre(){return $this->juz_nombre;}


//-----------------Insert---------------
	function insert($juz_nombre){
	    $sql= "INSERT INTO Juzgados (juz_nombre)
	    VALUES ('{$juz_nombre}')";
	    return($this->ejecutar($sql));
	}
	
//-----------------Delete---------------

	function delete($id){
	
	$sql="DELETE FROM Juzgados WHERE juz_id={$id}";
	$this->ejecutar($sql);
	}

//-----------------GetAll---------------

function getAll(){
		$sql = "SELECT * FROM Juzgados";
        $resultado=$this->ejecutar($sql);
		return $resultado;
}
}
?>