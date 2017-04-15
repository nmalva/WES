<?php 
session_start();
ob_start();
?>
<!--  CLASSES  -->
<?php 
include_once("../classes/class.bd.php");
include_once("../classes/class.actividades.php");
include_once("../classes/class.utiles.php");
?>

<!-- PHP FUNCTIONS -->
<?
function dibujarActividades(){
    $class_bd=new bd();
    $sql = "SELECT * FROM Actividades";
    $resultado=$class_bd->ejecutar($sql);

    while ($r=$class_bd->retornar_fila($resultado))
    {
        /*switch ($r["estado"]){
            case 0:
                $color="rgb(97,164,228)";
                break;
            case 1:
                $color="rgb(167,208,55)";
                break;
            case 2:
                $color="rgb(234,121,155)";
                break;
            case 3:
                $color="rgb(224,224,224)";
                break;
         }
         */
          $color="rgb(97,164,228)";
          $comentario=$r["act_comentario"];
        

        
   //     $start_date=$this->fecha_mysql_ingles($r["start_date"]);
    //    $end_date=$this->fecha_mysql_ingles($r["end_date"]);

        echo "
        {id:'{$r["act_id"]}', start_date: '{$r["act_fecha"]}', end_date: '{$r["act_fecha"]}', text: '{$comentario} '},
      
        ";
    }
}

?>
<!doctype html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>Basic initialization</title>
</head>
	<script src="../../calendario/codebase/dhtmlxscheduler.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="../../calendario/codebase/dhtmlxscheduler.css" type="text/css" media="screen" title="no title" charset="utf-8">
<script src="../../calendario/codebase/locale/locale_es.js" charset="utf-8"></script>
	
<style type="text/css" media="screen">
	html, body{
		margin:0px;
		padding:0px;
		height:100%;
		overflow:hidden;
	}	
</style>

<script type="text/javascript" charset="utf-8">
	function init() {
		scheduler.config.xml_date="%Y-%m-%d %H:%i";
		scheduler.init('scheduler_here', new Date(2015, 3, 18), "week");
		scheduler.parse([
			<?php dibujarActividades();?>
		], "json");

		scheduler.attachEvent("onClick", function(id,ev){
					
		});
		
	}
</script>

<body onload="init();">
	<div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100%;'>
		<div class="dhx_cal_navline">
			<div class="dhx_cal_prev_button">&nbsp;</div>
			<div class="dhx_cal_next_button">&nbsp;</div>
			<div class="dhx_cal_today_button"></div>
			<div class="dhx_cal_date"></div>
			<div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
			<div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
			<div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
		</div>
		<div class="dhx_cal_header">
		</div>
		<div class="dhx_cal_data">
		</div>
	</div>
</body>



<script>
function abrir_modal(){
	pagina = "caso_formulario.php?cas_id="+ cas_id;
	setTimeout(redireccionar, 100, pagina);	
}
function redireccionar_caso_actividades_tabla(cas_id){
	pagina = "caso_actividades_tabla.php?cas_id="+ cas_id;
	setTimeout(redireccionar, 100, pagina);	
}
function redireccionar(pagina) {
	{
	location.href=pagina;
	}             
}
</script>