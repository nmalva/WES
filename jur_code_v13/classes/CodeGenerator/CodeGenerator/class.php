<?php

include_once('Connect.class.php');


$operations="";
$class="";


if (isset($_POST['selectbase']))
{
	
	
	DatabaseConnection::set($_POST['server'],$_POST['user'],$_POST['pass'],$_POST['dbase']);
	$connect=DatabaseConnection::get()->handle();	

	$class.='<textarea cols="100%" rows="100%">';
	if ($_POST['selectbase']=="generar clase")
	{ 
		$class.= getCode($_POST['select'],$connect,'class');

	}
	if ($_POST['selectbase']=="generar Insert")
	{ 
		$class.= getCode($_POST['select'],$connect,'insert');
	}
	elseif ($_POST['selectbase']=="generar Select")
	{
		$class.= getCode($_POST['select'],$connect,'select');
	}	
	elseif ($_POST['selectbase']=="generar Update")
	{
		$class.= getCode($_POST['select'],$connect,'update');
	}	
	elseif ($_POST['selectbase']=="generar Delete")
	{
		$class.= getCode($_POST['select'],$connect,'delete');
	}	
	elseif ($_POST['selectbase']=="generar Abm")
	{
	    $class.= getCode($_POST['select'],$connect,'abm');
	}
	$class.='</textarea>';
		
} 


if (isset($_POST['submit'])||isset($_POST['selectbase']))
{
	DatabaseConnection::set($_POST['server'],$_POST['user'],$_POST['pass'],$_POST['dbase']);
	if($connect=DatabaseConnection::get()->handle())
	{
		$query=new Query();
		
		$result=$query->executeQuery('SHOW TABLES');
		$option='';
		while($row=mysql_fetch_array($result))
		{
			$option.='<option value="'.$row[0].'">'.$row[0].'</option>';
		}
		
		
		$operations.= 'Seleccione la Tabla 
							<select name ="select">'.$option.'
							</select>
							<input type="submit" name="selectbase" value ="generar clase"/>	
							<input type="submit" name="selectbase" value ="generar Select"/>	
							<input type="submit" name="selectbase" value ="generar Insert"/>	
							<input type="submit" name="selectbase" value ="generar Update"/>	
							<input type="submit" name="selectbase" value ="generar Delete"/>	
							<input type="submit" name="selectbase" value ="generar Abm"/>	
							';
	}
}
else
{
	// valores por defecto
$_POST['server']='localhost';
$_POST['user']='root';
$_POST['pass']='root';
$_POST['dbase']='JUDICIAL';
}



print'<html>
		<form method="post" action="class.php">
		<table>
		<tr><td><label>Server:</label></td><td><input name="server" type="text" value="'.$_POST['server'].'"/></td></tr>
		<tr><td><label>User:</label></td><td><input name="user" type="text" value="'.$_POST['user'].'"/></td></tr>
		<tr><td><label>Pass:</label></td><td><input name="pass" type="text" value="'.$_POST['pass'].'"/></td></tr>
		<tr><td><label>Database:</label></td><td><input  name="dbase" type="text" value="'.$_POST['dbase'].'"/></td></tr>
		<tr><td></td><td><input type="submit" name="submit" value ="conectar"/></td></tr>
		</table><br/>
		'.$operations.'
		</form>	
		'.$class.'
	 </html>';




function getCode($tabla,$connect,$op)
{
	$result = mysql_query("SELECT * FROM ".$tabla,$connect);
	$fields = mysql_num_fields($result);
	$rows   = mysql_num_rows($result);
	$table = mysql_field_table($result, 0);
	$a_data=Array();
	
	$buffer_atributes="";
	$buffer_set="";
	$buffer_get="";
	$primary_key=array();
	$primary_key_n=0;
	$buffer_mapping="\n\t\t".'$this->table="'.$table.'";';
	
	for ($i=0; $i < $fields; $i++) {
	    $type  = mysql_field_type($result, $i);
	    $name_original  = mysql_field_name($result, $i);
	   	$name=transformNames($name_original);
	    $len   = mysql_field_len($result, $i);
	    $flags = mysql_field_flags($result, $i);
	    $iskey=0;
	    
	    $a_data[$name_original]['type']=$type; 
	    $a_data[$name_original]['iskey']=false;
	    $a_data[$name_original]['flags']=$flags;
	    
	    if (searchFlag("primary_key",$flags))
	    {
	    	$primary_key[$primary_key_n]['value']=$name;
	    	$primary_key[$primary_key_n]['type']=$type;
	    	$a_data[$name_original]['iskey']=true;
	    	$iskey=1;
	    	$primary_key_n ++;
	    }
		
	    $buffer_set.=getSet($name,$type, $tabla);
	    $buffer_mapping.=setMapping($name_original,$name,$flags,$type,$len,$iskey);
		$buffer_get.=getGet($name);
	}
	for ($i=0; $i < $fields; $i++) { //este es un for igual para generar el abm
	    
	    
	    $type  = mysql_field_type($result, $i);
	    $name_original  = mysql_field_name($result, $i);
	    $name=transformNames($name_original);
	    $len   = mysql_field_len($result, $i);
	    $flags = mysql_field_flags($result, $i);
	    $iskey=0;
	     
	    $buffer_mapping2.="\t$"."campos[$name_original]=$"."_POST[$name_original];\n";
	        
	

	    
	}
	mysql_free_result($result);
	mysql_close();
	$classname=ucfirst($tabla);
	
	
	
	if ($op=='delete')
	{
		
		$where="";	
		foreach($a_data as $key=>$value)
		{
			if ($value['iskey'])
				{
						if ($value['type']=="int")
							{$where.=" ".$key."= $".transformNames($key);}
						else
							{$where.=" ".$key."='$".transformNames($key)."'";}
				}
		}
		return "delete ". $tabla .' where '.$where;
		
	}
	elseif ($op=='update')
	{
		
		$query="";
		$where="";	
		foreach($a_data as $key=>$value)
		{
			if ($value['iskey']==true)
				{
						if ($value['type']=="int")
							{$where.=" ".$key."= $".transformNames($key);}
						else
							{$where.=" ".$key."='$".transformNames($key)."'";}
				}
			else
				{	
						if ($value[$key]['type']=="int")
							{$query.=" ".$key."= $".transformNames($key);}
						else
							{$query.=" ".$key."='$".transformNames($key)."'";}
				}
		}
		return "update ". $tabla ." set ".$query .' where '.$where;
		
	}
	elseif ($op=='insert')
	{
		
				$sel="";
				$val="";
				foreach($a_data as $key=>$value)
				{
					if (!searchFlag('auto_increment',$value['flags']))
					{
							if (trim($sel)!="")
								{
									$sel.=",";
									$sel_top.=",";
									$val.=",";
								}
									
									
									if ($value['type']=="int")
										{$val.="'{"."$".transformNames($key)."}'";}
									else
										{$val.="'{"."$".transformNames($key)."}'";}
							$sel.=$key;
							$sel_top.="$".$key;
					}					
				}
				$insert.="function insert({$sel_top}){\n";
				$insert.="$"."sql= \"INSERT INTO ".$tabla." (".$sel.")\n VALUES (".$val.")\";\n";
				$insert.="return($"."this->ejecutar($"."sql));\n";
				$insert.="}\n";
				return $insert;
	}
	elseif ($op=='select')
	{
		
				$sel="";
				foreach($a_data as $key=>$value)
				{
							if (trim($sel)!="")
								{
									$sel.=",";
								}
							
							$sel.=$key;					
				}
				
				$select="select ".$sel." from ".$tabla;
				return $select;
	}
	elseif ($op=='class')
	{
		//*******************************************************// 
		$buffer="<?php\n";
		$buffer.="include_once('class.bd.php');//configurar en este archivo la conexion a base de datos \n\n";
		$buffer.="Class $classname extends bd \n { \n";
		
		$buffer.=getAtributes()."\n";
		$buffer.="\n\t".'//-----------------Mapping---------------'."\n";
			
		$buffer.=getMapping($buffer_mapping)."\n";
		$buffer.="\n\t".'//-----------------Constructor---------------'."\n";
		
		$buffer.=getConstructor($tabla, $primary_key)."\n";
		
		$buffer.="\n\t".'//-----------------Set Methods---------------'."\n";
		$buffer.=$buffer_set."\n";
		
		$buffer.="\n\t".'//-----------------Get Methods---------------'."\n";
		$buffer.=$buffer_get."\n";
		
		$buffer.="\n?>";
		
		return  $buffer;
		
	}
	elseif ($op=='abm')
	{
	    //*******************************************************//
	    $buffer="<?php\n";
	    $buffer="session_start();\nob_start();\n";
	    $buffer.="include_once('..\classes\class.".strtolower($tabla).".php');\n\n";
		
	    $buffer.="\n\t".'//-----------------Campos---------------'."\n";
	    	
	    $buffer.=getMapping2($buffer_mapping2)."\n";
	    $buffer.="\n\t".'//-----------------Insert---------------'."\n";
	
	    $sel="";
	    $val="";
	    foreach($a_data as $key=>$value)
	    {
	        if (!searchFlag('auto_increment',$value['flags']))
	        {
	            if (trim($sel)!="")
	            {
	                $sel.=",";
	                $sel_top.=",";
	            }
	            	
	            	
	            if ($value['type']=="int")
	              {$val.="\t\t\t$"."campos[\"".transformNames($key)."\"],\n";}
	            else
	               {$val.="\t\t\t$"."campos[\"".transformNames($key)."\"],\n";}
	            $sel.=$key;
	            $sel_top.="$".$key;
	        }
	    }
	    $buffer.="\tfunction insert(){\n";
	    $buffer.="\t\tglobal $"."campos;\n";
	    $buffer.="\t\t$"."class_".strtolower($tabla)."= new ".$tabla."();\n";
	    $buffer.="\t\t$"."new_id=$"."class_".strtolower($tabla)."->insert(\n";
	    $buffer.=$val."\t\t\t);\n";
	    $buffer.="\t}";
	    
	    $buffer.="\n\t".'//-----------------Update---------------'."\n";
	    
	    $sel="";
	    $val="";
	    foreach($a_data as $key=>$value)
	    {
	        if (!searchFlag('auto_increment',$value['flags']))
	        {
	            if (trim($sel)!="")
	            {
	                $sel.=",";
	                $sel_top.=",";
	            }
	    
	    
	            if ($value['type']=="int")
	               {$val.="\t\t\t$"."class_".strtolower($tabla)."->set".ucfirst($key)."($"."campos[\"".transformNames($key)."\"]);\n";}
	            else
	               {$val.="\t\t\t$"."class_".strtolower($tabla)."->set".ucfirst($key)."($"."campos[\"".transformNames($key)."\"]);\n";}
	            $sel.=$key;
	            $sel_top.="$".$key;
	        }
	    }
	    $buffer.="\tfunction update(){\n";
	    $buffer.="\t\tglobal $"."campos;\n";
	    $buffer.="\t\t$"."class_".strtolower($tabla)."= new ".$tabla."($"."campos[\"XXX_id\"]);\n\n";
	    
	    $buffer.=$val."\t\t\t\n";
	    
	    $buffer.="\t}";
	
	    return  $buffer;
	
	}
}



function getMapping($mapping)
{
	$bmapping="\n\t".'function Mapping($r)';
	$bmapping.="\n\t".'{';
	$bmapping.=$mapping;
	$bmapping.="\n\t".'}';
	return $bmapping;
}

function getMapping2($mapping)
{
    $bmapping="\n\t";
    $bmapping.="\n\t";
    $bmapping.=$mapping;
    $bmapping.="\n\t";
    return $bmapping;
}


function setMapping($nameOriginal,$name,$flags,$type,$len,$iskey)
{
	
	$mapping.="\n\t\t".'$this->'.$nameOriginal.'=$r["'.$nameOriginal.'"];';
	return $mapping;
}

function searchFlag($flag,$fieldsFlag)
{
	if (trim($fieldsFlag)=="")
		{
			return false;
		}
	if(strpos($fieldsFlag,$flag)!==false)
		{
			return true;
		}
	else
		{
			return false;
		}
}
function transformNames($field)
{
	$array=array();
	$array=explode('/',$field);
	$final_name="";
	foreach($array as $key=>$value)
	{
		if ($key!=0)
		{$value=ucfirst($value);}
		$final_name.=$value;		
	}
	return $final_name;
}

function getConstructor($tabla,$primary_key)
{	
	$ifvars="if($"."id>0";
	$ifvars.=")";	
	$tabla=ucfirst($tabla);    	
	$con="\n\t".'function __construct($id = 0)';
	$con.="\n\t".'{'."\n\t\t";
	$con.= "parent::__construct(); //cambio";
	$field_prefix=strtolower(substr($tabla,0,3));
	

	$con.="\n\t\t".$ifvars;
	$con.="\n\t\t\t".'{';

	$con.="\n\t\t\t".'
                            $sql = "SELECT * FROM '.$tabla.' WHERE '.$field_prefix.'_id = {$id}";
                            $resultado=$this->ejecutar($sql);
                            $r = $this->retornar_fila($resultado);
            	           ';
            		
	$con.="\n\t\t\t".'}';
	$con.="\n\t\t".'$this->Mapping($r);';
	$con.="\n\t".'}'."\n";
	return $con;	
}
function getAtributes()
{
	$attr="\n\t".'private $table;';
	$attr.="\n\t".'private $fields=array();';
	return $attr;
}

function getSet($field,$type, $tabla)
{
    $fieldprefix= strtolower(substr($tabla,0,3));
	$ufield=ucfirst($field);    	
	$set="\n\t".'function set'.$ufield.'($value){';
	$set.="\n\t".'';
	
	$set.= '$sql="UPDATE '. $tabla.'  SET '.$field.'='.'\'{$value}\' WHERE '.$fieldprefix.'_id={$this->'.$fieldprefix.'_id}";';
	
	$set.="\n\t".'';
	$set.= '$this-> ejecutar($sql);';
	$set.="\n\t".'';
	$set.="}";
	return $set;	
}

function getGet($field)
{
	$ufield=ucfirst($field);    	
	$get="\n\t".'function get'.$ufield.'()';
	$get.='{';
	$get.='return $this->'.$field.';';
	$get.='}';
	return $get;	
}


function getWhere($primary_key)
{
	$where="";
	foreach($primary_key as $key=>$value)
	{
		if ($value['type']=="int")
			{$where.=" ".$value['value']."=$".$value['value'];}
		else
			{$where.=" ".$value['value']."=\'$". $value['value']."\'";}
	}
	
	return $where;

}

function getUpdate()
{
$val=	
"\n\t".'function update() 
	{
		$query="";
		$where="";	
		foreach($this->fields as $key=>$value)
		{
			if ($this->fields[$key][isKey])
				{
						if ($this->fields[$key][type]=="int")
							{$where.=" ".$key."=".intval($value);}
						else
							{$where.=" ".$key."=\'".tep_db_escape_string($value)."\'";}
				}
			else
				{	
					if ($this->fields[$key][change]=true)
					{
						if ($this->fields[$key][type]=="int")
							{$query.=" ".$key."=".intval($value);}
						else
							{$query.=" ".$key."=\'".tep_db_escape_string($value)."\'";}
					}
				}
		}
		if (trim($query)=="" or trim($where)=="" )
			{return false;}
			
			
		$sql="update ". $this->table ." set ".$query ." where ".$where;
		
		$query=new Query();
		$query->executeQuery($sql);
	}';
return $val;
}


?>