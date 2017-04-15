<?php include ("includes/title.php");?>
<?php //include ("includes/security_session.php");?>
<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
<!--  BEGIN INCLUDE CLASSES -->
<?php include_once("../classes/class.casos.php");?>
<?php include_once("../classes/class.usuarios.php");?>
<?php include_once("../classes/class.actividades.php");?>
<?php include_once("../classes/class.utiles.php");?>
<?php include_once("../classes/class.bd.php");?>
<!--  END INCLUDE CLASSES -->

<!--  BEGIN GLOBAL VARIABLES -->
<?php 
$session_usu_id= $_SESSION["usu_id"];
$get_cas_id=$_GET["cas_id"];
?>
<!--  END GLOBAL VARIABLES -->

<!--  BEGIN PHP FUNCTIONS -->
<?php 
function dibujarActividades(){
    $class_bd=new bd();    
    $sql="SELECT * FROM Actividades
    INNER JOIN TipoActividad  on Actividades.tia_id       =     TipoActividad.tia_id
    INNER JOIN CompartirCasos on Actividades.cas_id       =     CompartirCasos.cas_id
    
    WHERE (act_estado=0 or act_estado =1 or act_estado=2) 
    AND tia_popup=1
    AND CompartirCasos.usu_id='{$_SESSION["usu_id"]}'";  
    
    //(act_estado (0) abierto, (1)verificar, (2)reveer)  no muestra los cerrados
    // tia_popup=1. Muestra solo las actividades que no son comentarios y demas
    // Compartir Casos... La última línea para mostrar actividades en casos compartidos
    
    
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
          $texto=$r["tia_nombre"];
        

        
   //     $start_date=$this->fecha_mysql_ingles($r["start_date"]);
    //    $end_date=$this->fecha_mysql_ingles($r["end_date"]);

        echo "
        {id:'{$r["act_id"]}', start_date: '{$r["act_fecha"]}', end_date: '{$r["act_fecha"]}', text: '{$texto} '},
      
        ";
    }
}

?>
<head>

<!--  PAGE TITLE  -->
<?php include ("includes/pagetitle.php");?>
<!--  END PAGE TITLE  -->

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<?php include("includes/globalstyle.html");?>
<!-- END GLOBAL MANDATORY STYLES -->

 
<script src="../../calendario/codebase/dhtmlxscheduler.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="../../calendario/codebase/dhtmlxscheduler.css" type="text/css" media="screen" title="no title" charset="utf-8">	
<script src="../../calendario/codebase/locale/locale_es.js" charset="utf-8"></script>
<script src="../../calendario/codebase/ext/dhtmlxscheduler_collision.js"></script>
<script src="../../calendario/codebase/ext/dhtmlxscheduler_expand.js"type="text/javascript"></script>

<!-- BEGIN PAGE LEVEL STYLES USED BY TABLE-->
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/select2/select2.css" />
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css" />
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css" />
<link rel="stylesheet" type="text/css"
	href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css" />
<!-- END PAGE LEVEL STYLES -->


	
<!-- BEGIN THEME STYLES -->
<?php include ("includes/themestyle.html")?>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
	
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
		scheduler.config.show_loading = true;
		scheduler.config.drag_create = false;
		scheduler.config.drag_move = false;
		scheduler.config.drag_resize = false;
		scheduler.init('scheduler_here', new Date(), "month");
		scheduler.parse([
			<?php dibujarActividades();?>
		], "json");
            
		

		scheduler.attachEvent("onClick", function(id,ev){
			$('#ajax').modal({
		        show: true,
		        remote: 'caso_actividades_modal.php?act_id='+id	
		        });
		});
		
		
	}
</script>

<body onload="init();">
	<!-- BEGIN HEADER -->
	<div class="page-header">
		<!-- BEGIN HEADER TOP -->
	    <?php include("includes/headertop.php");?>
	<!-- END HEADER TOP -->
		<!-- BEGIN HEADER MENU -->
	   <?php include("includes/headermenu.php");?>
	<!-- END HEADER MENU -->
	</div>
	<!-- END HEADER -->
	<!-- BEGIN PAGE CONTAINER -->
	
	<div id="scheduler_here" class="dhx_cal_container" style='width:99%; height:83%;'>
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

<!-- BEGIN MODAL -->
	<div class="modal fade" id="ajax" role="basic" aria-hidden="true">
		<div class="page-loading page-loading-boxed">
			<img src="../../assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
			<span>
			&nbsp;&nbsp;Loading... </span>
		</div>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
			</div>
		</div>
	</div>
	<!-- END MODAL -->
	
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<?php include("includes/coreplugins.html");?>
<!-- END CORE PLUGINS -->


<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript"
	src="../../assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript"
	src="../../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript"
	src="../../assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript"
	src="../../assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript"
	src="../../assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript"
	src="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
	
	

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../assets/global/scripts/metronic.js"
	type="text/javascript"></script>
<script src="../../assets/admin/layout3/scripts/layout.js"
	type="text/javascript"></script>
<script src="../../assets/admin/layout3/scripts/demo.js"
	type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/table-advanced.js"></script>





<script>
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
   Layout.init(); // init current layout    
   Demo.init(); // init demo features
   TableAdvanced.init();
});

//--START JAVASCRIPT FUNCTIONS--
function redireccionar_caso_formulario(cas_id){
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
//--END JAVASCRIPT FUNCTIONS--
</script>

</body>
<!-- END BODY -->
</html>