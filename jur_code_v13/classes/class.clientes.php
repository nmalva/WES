<?php
include_once('class.bd.php');//configurar en este archivo la conexion a base de datos 

Class Clientes extends bd
 { 

	private $table;
	private $fields=array();

	//-----------------Mapping---------------

    function Mapping($r)
	{
		$this->table="Clientes";
		$this->cli_id=$r["cli_id"];
		$this->cli_nombre=$r["cli_nombre"];
		$this->cli_apellido=$r["cli_apellido"];
		$this->cli_direccion=$r["cli_direccion"];
		$this->cli_ciudad=$r["cli_ciudad"];
		$this->cli_provincia=$r["cli_provincia"];
		$this->cli_fijo=$r["cli_fijo"];
		$this->cli_movil=$r["cli_movil"];
		$this->cli_email=$r["cli_email"];
		$this->cli_dni=$r["cli_dni"];
		$this->pro_id=$r["pro_id"];
		$this->loc_id=$r["loc_id"];
		$this->cli_timestamp=$r["cli_timestamp"];
	}

	//-----------------Constructor---------------

	function __construct($id = 0)
	{
	    parent::__construct(); //cambio
		if($id>0)
			{
			
                            $sql = "SELECT * FROM Clientes WHERE cli_id = {$id}";
                            $resultado=$this->ejecutar($sql);
                            $r = $this->retornar_fila($resultado);
            	           
			}
		$this->Mapping($r);
	}


	//-----------------Set Methods---------------

	function setCli_id($value){
	$sql="UPDATE Clientes  SET cli_id='{$value}' WHERE cli_id={$this->cli_id}";
	$this-> ejecutar($sql);
	}
	function setCli_nombre($value){
	$sql="UPDATE Clientes  SET cli_nombre='{$value}' WHERE cli_id={$this->cli_id}";
	$this-> ejecutar($sql);
	}
	function setCli_apellido($value){
	$sql="UPDATE Clientes  SET cli_apellido='{$value}' WHERE cli_id={$this->cli_id}";
	$this-> ejecutar($sql);
	}
	function setCli_direccion($value){
	$sql="UPDATE Clientes  SET cli_direccion='{$value}' WHERE cli_id={$this->cli_id}";
	$this-> ejecutar($sql);
	}
	function setCli_ciudad($value){
	$sql="UPDATE Clientes  SET cli_ciudad='{$value}' WHERE cli_id={$this->cli_id}";
	$this-> ejecutar($sql);
	}
	function setCli_provincia($value){
	$sql="UPDATE Clientes  SET cli_provincia='{$value}' WHERE cli_id={$this->cli_id}";
	$this-> ejecutar($sql);
	}
	function setCli_fijo($value){
	$sql="UPDATE Clientes  SET cli_fijo='{$value}' WHERE cli_id={$this->cli_id}";
	$this-> ejecutar($sql);
	}
	function setCli_movil($value){
	$sql="UPDATE Clientes  SET cli_movil='{$value}' WHERE cli_id={$this->cli_id}";
	$this-> ejecutar($sql);
	}
	function setCli_email($value){
	$sql="UPDATE Clientes  SET cli_email='{$value}' WHERE cli_id={$this->cli_id}";
	$this-> ejecutar($sql);
	}
	function setCli_dni($value){
	$sql="UPDATE Clientes  SET cli_dni='{$value}' WHERE cli_id={$this->cli_id}";
	$this-> ejecutar($sql);
	}
	function setPro_id($value){
	    $sql="UPDATE Clientes  SET pro_id='{$value}' WHERE cli_id={$this->cli_id}";
	    $this-> ejecutar($sql);
	}
	function setLoc_id($value){
	    $sql="UPDATE Clientes  SET loc_id='{$value}' WHERE cli_id={$this->cli_id}";
	    $this-> ejecutar($sql);
	}
	function setCli_timestamp($value){
	$sql="UPDATE Clientes  SET cli_timestamp='{$value}' WHERE cli_id={$this->cli_id}";
	$this-> ejecutar($sql);
	}

	//-----------------Get Methods---------------

	function getCli_id(){return $this->cli_id;}
	function getCli_nombre(){return $this->cli_nombre;}
	function getCli_apellido(){return $this->cli_apellido;}
	function getCli_direccion(){return $this->cli_direccion;}
	function getCli_ciudad(){return $this->cli_ciudad;}
	function getCli_provincia(){return $this->cli_provincia;}
	function getCli_fijo(){return $this->cli_fijo;}
	function getCli_movil(){return $this->cli_movil;}
	function getCli_email(){return $this->cli_email;}
	function getCli_dni(){return $this->cli_dni;}
	function getPro_id(){return $this->pro_id;}
	function getLoc_id(){return $this->loc_id;}
	function getCli_timestamp(){return $this->cli_timestamp;}


//-----------------Insert---------------

	function insert($cli_nombre,$cli_apellido,$cli_direccion,$pro_id,$loc_id,$cli_fijo,$cli_movil,$cli_email,$cli_dni){
	    $sql= "INSERT INTO Clientes (cli_nombre,cli_apellido,cli_direccion,pro_id,loc_id,cli_fijo,cli_movil,cli_email,cli_dni)
	    VALUES ('{$cli_nombre}','{$cli_apellido}','{$cli_direccion}','{$pro_id}','{$loc_id}','{$cli_fijo}','{$cli_movil}','{$cli_email}','{$cli_dni}')";
	    return($this->ejecutar($sql));
	}
	
	
//-----------------Delete---------------

	function delete($id){
	
	$sql="DELETE FROM Clientes WHERE act_id={$id}";
	$this->ejecutar($sql);
	}

//-----------------GetAll---------------

function getAll(){
		$sql = "SELECT * FROM Clientes";
        $resultado=$this->ejecutar($sql);
		return $resultado;
}

}
?>