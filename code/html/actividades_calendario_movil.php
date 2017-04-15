<?php include ("includes/title.php");?>
<?php //include ("includes/security_session.php");?>
<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
 <meta  name = "viewport" content = "initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no">
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
    INNER JOIN Casos          on Casos.cas_id             =     Actividades.cas_id
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
          $texto=$r["tia_nombre"]. "<nl2br> | Expediente: ". $r["cas_legajo1"];
          
          If ($r[act_comentario]==""){
              $detalles="<p><b>Carátula: {$r[cas_caratula]} </b></p> Nota: no hay nota...";
          }else{
              $detalles ="<p><b> Carátula: {$r[cas_caratula]} </b></p>Nota:  ".str_replace("\n", "", $r[act_comentario]);
          }
          

        
   //     $start_date=$this->fecha_mysql_ingles($r["start_date"]);
    //    $end_date=$this->fecha_mysql_ingles($r["end_date"]);

        echo "
        {id:'{$r["act_id"]}', start_date: '{$r["act_fecha"]}', end_date: '{$r["act_fecha"]}', text: '{$texto} ', details: '{$detalles}'},
      
        ";
    }
}

?>
<head>

<!--  PAGE TITLE  -->
<?php include ("includes/pagetitle.php");?>
<!--  END PAGE TITLE  -->

 
<script src="../../calendario_movil/codebase/dhxscheduler_mobile.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../../calendario_movil/codebase/dhxscheduler_mobile.css">

	
<!-- BEGIN THEME STYLES -->
<?php include ("includes/themestyle.html")?>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico" />
<script type="text/javascript" charset="utf-8">
			var data = [
				<?php dibujarActividades();?>
			];
			/*initial date (today by default)*/
			scheduler.config.init_date = new Date();
			scheduler.config.readonly = true;

			scheduler.locale.labels = {
					list_tab: "Lista",
					day_tab: "Día",
					month_tab: "Mes",
					icon_today: "Hoy",
					icon_save: "Guardar",
					icon_done: "Aceptar",
					icon_delete: "Delete event",
					icon_cancel: "Cancelar",
					icon_edit: "Editar",
					icon_back: "Volver",
					icon_close: "Cerrar formulario",
					icon_yes: "Si",
					icon_no: "No",
					confirm_closing: "Your changes will be lost, are your sure ?",
					confirm_deleting: "The event will be deleted permanently, are you sure?",
					label_event: "Event", 
					label_start: "Start",
					label_end: "End",
					label_details: "Notas",
					label_from: "desde las",
					label_to: "hasta las ",
					label_allday: "All day",
					label_time: "Time"
				};

			dhx.ready(function(){
				dhx.ui.fullScreen();
				
    			dhx.ui({
					view: "scheduler",
					id: "scheduler"
				});
				$$("scheduler").parse(data,"json");
				//scheduler.attachEvent("onClick", function (event_id, native_event_object){
				//	alert("hola");
				//});
			});

		
		</script>

<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body>
	
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






<script>
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
   Layout.init(); // init current layout    
   Demo.init(); // init demo features
  
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