<?php
include_once('class.bd.php');//configurar en este archivo la conexion a base de datos 

Class Usuarios extends bd
 { 

	private $table;
	private $fields=array();

	//-----------------Mapping---------------

	function Mapping($r)
	{
		$this->table="Usuarios";
		$this->usu_id=$r["usu_id"];
		$this->usu_nombre=$r["usu_nombre"];
		$this->usu_apellido=$r["usu_apellido"];
		$this->usu_usuario=$r["usu_usuario"];
		$this->usu_clave=$r["usu_clave"];
		$this->usu_perfil=$r["usu_perfil"];
		$this->usu_timestamp=$r["usu_timestamp"];
	}

	//-----------------Constructor---------------

	function __construct($id = 0)
	{
	    parent::__construct(); //cambio
		if($id>0)
			{
			
                            $sql = "SELECT * FROM Usuarios WHERE usu_id = {$id}";
                            $resultado=$this->ejecutar($sql);
                            $r = $this->retornar_fila($resultado);
            	           
			}
		$this->Mapping($r);
	}


	//-----------------Set Methods---------------

	function setUsu_id($value){
	$sql="UPDATE Usuarios  SET usu_id='{$value}' WHERE usu_id={$this->usu_id}";
	$this-> ejecutar($sql);
	}
	function setUsu_nombre($value){
	$sql="UPDATE Usuarios  SET usu_nombre='{$value}' WHERE usu_id={$this->usu_id}";
	$this-> ejecutar($sql);
	}
	function setUsu_apellido($value){
	$sql="UPDATE Usuarios  SET usu_apellido='{$value}' WHERE usu_id={$this->usu_id}";
	$this-> ejecutar($sql);
	}
	function setUsu_usuario($value){
	$sql="UPDATE Usuarios  SET usu_usuario='{$value}' WHERE usu_id={$this->usu_id}";
	$this-> ejecutar($sql);
	}
	function setUsu_clave($value){
	$sql="UPDATE Usuarios  SET usu_clave='{$value}' WHERE usu_id={$this->usu_id}";
	$this-> ejecutar($sql);
	}
	function setUsu_perfil($value){
	$sql="UPDATE Usuarios  SET usu_perfil='{$value}' WHERE usu_id={$this->usu_id}";
	$this-> ejecutar($sql);
	}
	function setUsu_timestamp($value){
	$sql="UPDATE Usuarios  SET usu_timestamp='{$value}' WHERE usu_id={$this->usu_id}";
	$this-> ejecutar($sql);
	}

	//-----------------Get Methods---------------

	function getUsu_id(){return $this->usu_id;}
	function getUsu_nombre(){return $this->usu_nombre;}
	function getUsu_apellido(){return $this->usu_apellido;}
	function getUsu_usuario(){return $this->usu_usuario;}
	function getUsu_clave(){return $this->usu_clave;}
	function getUsu_perfil(){return $this->usu_perfil;}
	function getUsu_timestamp(){return $this->usu_timestamp;}

//-----------------Insert---------------
	function insert($usu_nombre,$usu_apellido,$usu_usuario,$usu_clave,$usu_perfil,$usu_timestamp){
	    $sql= "INSERT INTO Usuarios (usu_nombre,usu_apellido,usu_usuario,usu_clave,usu_perfil,usu_timestamp)
	    VALUES ('{$usu_nombre}','{$usu_apellido}','{$usu_usuario}','{$usu_clave}','{$usu_perfil}','{$usu_timestamp}')";
	    return($this->ejecutar($sql));
	}
	
//-----------------Delete---------------

	function delete($id){
	
	$sql="DELETE FROM Usuarios WHERE usu_id={$id}";
	$this->ejecutar($sql);
	}

//-----------------GetAll---------------

function getAll(){
		$sql = "SELECT * FROM Usuarios";
        $resultado=$this->ejecutar($sql);
		return $resultado;
}
}
?>