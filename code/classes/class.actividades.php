<?php
include_once('class.bd.php');//configurar en este archivo la conexion a base de datos 

Class Actividades extends bd
 { 

	private $table;
	private $fields=array();

	//-----------------Mapping---------------

    function Mapping($r)
	{
		$this->table="Actividades";
		$this->act_id=$r["act_id"];
		$this->cas_id=$r["cas_id"];
		$this->tia_id=$r["tia_id"];
		$this->act_estado=$r["act_estado"];
		$this->usu_idemisor=$r["usu_idemisor"];
		$this->usu_idresponsable=$r["usu_idresponsable"];
		$this->act_comentario=$r["act_comentario"];
		$this->act_fecha=$r["act_fecha"];
		$this->act_fechacierre=$r["act_hora"];
		$this->act_timestamp=$r["act_timestamp"];
	}

	//-----------------Constructor---------------

	function __construct($id = 0)
	{
	    parent::__construct(); //cambio
		if($id>0)
			{
			
                            $sql = "SELECT * FROM Actividades WHERE act_id = {$id}";
                            $resultado=$this->ejecutar($sql);
                            $r = $this->retornar_fila($resultado);
            	           
			}
		$this->Mapping($r);
	}


	//-----------------Set Methods---------------

	function setAct_id($value){
	$sql="UPDATE Actividades  SET act_id='{$value}' WHERE act_id={$this->act_id}";
	$this-> ejecutar($sql);
	}
	function setCas_id($value){
	$sql="UPDATE Actividades  SET cas_id='{$value}' WHERE act_id={$this->act_id}";
	$this-> ejecutar($sql);
	}
	function setTia_id($value){
	$sql="UPDATE Actividades  SET tia_id='{$value}' WHERE act_id={$this->act_id}";
	$this-> ejecutar($sql);
	}
	function setAct_estado($value){
	$sql="UPDATE Actividades  SET act_estado='{$value}' WHERE act_id={$this->act_id}";
	$this-> ejecutar($sql);
	}
	function setUsu_idemisor($value){
	$sql="UPDATE Actividades  SET usu_idemisor='{$value}' WHERE act_id={$this->act_id}";
	$this-> ejecutar($sql);
	}
	function setUsu_idresponsable($value){
	$sql="UPDATE Actividades  SET usu_idresponsable='{$value}' WHERE act_id={$this->act_id}";
	$this-> ejecutar($sql);
	}
	function setAct_comentario($value){
	$sql="UPDATE Actividades  SET act_comentario='{$value}' WHERE act_id={$this->act_id}";
	$this-> ejecutar($sql);
	}
	function setAct_fecha($value){
	$sql="UPDATE Actividades  SET act_fecha='{$value}' WHERE act_id={$this->act_id}";
	$this-> ejecutar($sql);
	}
	function setAct_fechacierre($value){
	$sql="UPDATE Actividades  SET act_fechacierre='{$value}' WHERE act_id={$this->act_id}";
	$this-> ejecutar($sql);
	}
	function setAct_timestamp($value){
	$sql="UPDATE Actividades  SET act_timestamp='{$value}' WHERE act_id={$this->act_id}";
	$this-> ejecutar($sql);
	}

	//-----------------Get Methods---------------

	function getAct_id(){return $this->act_id;}
	function getCas_id(){return $this->cas_id;}
	function getTia_id(){return $this->tia_id;}
	function getAct_estado(){return $this->act_estado;}
	function getUsu_idemisor(){return $this->usu_idemisor;}
	function getUsu_idresponsable(){return $this->usu_idresponsable;}
	function getAct_comentario(){return $this->act_comentario;}
	function getAct_fecha(){return $this->act_fecha;}
	function getAct_fechacierre(){return $this->act_fechacierre;}
	function getAct_timestamp(){return $this->act_timestamp;}

//-----------------Insert---------------

    function insert($cas_id,$tia_id,$act_estado,$usu_idemisor,$usu_idresponsable,$act_comentario,$act_fecha){
        
        $sql= "INSERT INTO Actividades (cas_id,tia_id,act_estado,usu_idemisor,usu_idresponsable,act_comentario, act_fecha)
                VALUES ('{$cas_id}','{$tia_id}','{$act_estado}','{$usu_idemisor}','{$usu_idresponsable}','{$act_comentario}','{$act_fecha}')";
    return($this->ejecutar($sql));
    }
//-----------------Delete---------------

	function delete($id){
	
	$sql="DELETE FROM Actividades WHERE act_id={$id}";
	$this->ejecutar($sql);
	}

//-----------------GetAll---------------

function getAll(){
		$sql = "SELECT * FROM Actividades";
        $resultado=$this->ejecutar($sql);
		return $resultado;
}
}
?>