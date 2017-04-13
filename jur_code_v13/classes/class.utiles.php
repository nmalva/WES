<?php
require_once("class.bd.php");

class utiles extends bd
{

function __construct($id = 0)          //recibe como parametro el id, sino lo pone en 0, a hace referencia a la cantidad de campos mostrables del POST del formulario
    {
      parent::__construct();

      //$this->numero_estado=$numero_estado;
      /*
      if($id > 0)
      {
        $sql = "SELECT * FROM estado WHERE idestado = {$id}";
        $resultado=$this->ejecutar($sql);
        $r = $this->retornar_fila($resultado);
        
		$this->descripcion=$r["descripcion"];
        $this->id = $id;
        
      }
	  */
    }


function fecha_mysql_timestamp(){
    $mysql = date("Y-m-d H:i");
    return($mysql);
}
    
    
function fecha_mysql(){
	$mysql=date('Y-m-d');
	return ($mysql);
 }

function fecha_mysql_php($mysql){

	$PhpDate = strtotime($mysql);
	$php = date('d/m/Y', $PhpDate);
	return ($php);
 }
 
function fecha_mysql_php_format($mysql){
 
     $PhpDate = strtotime($mysql);
     $php = date('M - d', $PhpDate);
     return ($php);
 }
function fecha_mysql_php_export($mysql){
 
     $PhpDate = strtotime($mysql);
     $php = date('d-m-Y', $PhpDate);
     return ($php);
}

function fecha_mysql_php_datetime($mysql){
    $time = strtotime($mysql);
    $php = date("d/m/Y - H:i", $time);
    return($php);
}

function fecha_php_mysql($php){
    list($dia,$mes,$ano)=explode("/",$php);
    $mysql="$ano-$mes-$dia";
    return $mysql;
}

function fecha_php_mysql_datetime($php){
    $mysql = preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4', $php);
    return $mysql;
}

function cant_dias($fecha_i,$fecha_f)
{
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); $dias = floor($dias);		
	return $dias;
}

/** * Compara dos fechas en formato Y-m-d *
  @param String $fecha1 Fecha 1 *
  @param String $fecha2 Fecha 2 * @return Int * 
	0: Las fechas son iguales *
  1: La fecha 1 es mayor * 
	2: La fecha 1 es menor **/ 

function compararFechas($fecha1, $fecha2){ 

if(strcmp($fecha1,$fecha2) < 0) return 0; //Fecha 1< Fecha 2
if(strcmp($fecha1,$fecha2) == 0)return 1;
if(strcmp($fecha1,$fecha2) > 0) return 2; 

}


function disponibilidad_fecha($start_date, $end_date, $evaluame) {
    $start_ts = strtotime($start_date);
    $end_ts = strtotime($end_date);
    $user_ts = strtotime($evaluame);
    return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}


function fecha_actual($fecha){
	 list($nn,$mes,$dia,$ano)=explode(" ",$fecha);
		
	 switch ($mes) {
    case 'Jan':
        $mes = 1;
        break;
    case "Feb":
        $mes = 2;
        break;
    case "Mar":
        $mes = 3;
				break;
		case "Apr":
        $mes = 4;
				break;
		case "May":
				$mes = 5;
				break;
		case "Jun":
				$mes = 6;
				break;
		case "Jul":
				$mes = 7;
				break;
		case "Aug":
				$mes = 8;
				break;
		case "Sep":
				$mes = 9;
				break;
		case "Oct":
				$mes = 10;
				break;
		case "Nov":
				$mes = 11;
				break;
		case "Dic":
				$mes = 12;
        break;
		}
	
	return ($dia."-".$mes."-".$ano);
	}

function CortarTexto($texto,$inicio, $fin){
	$texto_cortado =substr ($texto , $inicio,$fin);
	return $texto_cortado;

}
}

?>