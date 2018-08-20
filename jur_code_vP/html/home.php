<?php include ("includes/title.php");?>
<?php include ("includes/security_session.php");?>
<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta name="tipo_contenido" content="text/html;"
	http-equiv="content-type" charset="utf-8">
<!--  BEGIN INCLUDE CLASSES -->
<?php include_once("../classes/class.casos.php");?>
<?php include_once("../classes/class.utiles.php");?>
<?php include_once("../classes/class.bd.php");?>

<!--  END INCLUDE CLASSES -->

<!--  BEGIN GLOBAL VARIABLES -->
<?php


$session_usu_id= $_SESSION["usu_id"];
$session_device_type=$_SESSION["device_type"];

?>
<!--  END GLOBAL VARIABLES -->

<!--  BEGIN PHP FUNCTIONS -->
<?php 
function get_cantidad_actividades(){
    $class_bd=new bd();
    $sql="SELECT count(*) FROM Actividades
          INNER JOIN TipoActividad   on Actividades.tia_id = TipoActividad.tia_id
          INNER JOIN Usuarios        on Actividades.usu_idemisor = Usuarios.usu_id
           INNER JOIN CompartirCasos on Actividades.cas_id=CompartirCasos.cas_id
          WHERE (act_estado=0 or act_estado =1 or act_estado=2) 
          AND tia_popup=1
          AND tia_diaprevio > 0  
    	  AND act_fecha <= DATE_ADD(CURDATE(), INTERVAL tia_diaprevio DAY)
          AND CompartirCasos.usu_id='{$_SESSION["usu_id"]}'";  //act_estad=o=0 es abierto
         
    $resultado=$class_bd->ejecutar($sql);
    return(mysql_result($resultado, 0));
}

function get_cantidad_casos($session_usu_id){
    $class_bd=new bd();
    $sql="SELECT count(*) FROM Casos 
            INNER JOIN Clientes on Casos.cli_id = Clientes.cli_id
            INNER JOIN Jurisdicciones on Casos.jur_id = Jurisdicciones.jur_id
            INNER JOIN Juzgados    on Casos.juz_id = Juzgados.juz_id
            INNER JOIN Materias    on Casos.mat_id = Materias.mat_id
            INNER JOIN EstadoCaso  on Casos.esc_id = EstadoCaso.esc_id
            INNER JOIN CompartirCasos on Casos.cas_id=CompartirCasos.cas_id 
          WHERE usu_id={$session_usu_id}";
    $resultado=$class_bd->ejecutar($sql);
    return(mysql_result($resultado, 0));
}

function get_cantidad_clientes(){
    $class_bd=new bd();
    $sql="SELECT count(*) FROM Clientes";
    $resultado=$class_bd->ejecutar($sql);
    return(mysql_result($resultado, 0));
}
?>



<head>

<!--  PAGE TITLE  -->
<?php include ("includes/pagetitle.php");?>
<!--  END PAGE TITLE  -->

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<?php include("includes/globalstyle.html");?>
<!-- END GLOBAL MANDATORY STYLES -->

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

<body>
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
	<div class="page-container">
		<!-- BEGIN PAGE HEAD -->
		
		<!-- END PAGE HEAD -->
		<!-- BEGIN PAGE CONTENT -->
		<div class="page-content">
			<div class="container">
				
				<!-- /.modal -->
				<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
				<!-- BEGIN PAGE BREADCRUMB -->
				<!-- END PAGE BREADCRUMB -->
				<!-- BEGIN PAGE CONTENT INNER -->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-cogs font-blue-sharp"></i> <span
										class="caption-subject font-blue-sharp bold uppercase">Menu Principal</span>
								</div>
								<div class="tools"></div>
							</div>
							<div class="portlet-body">

							
							
								<div class="tiles">
									<div class="tile bg-blue-hoki" onclick="<?php if ($session_device_type=="phone") 
                                            echo "redireccionar_actividades_calendario_movil();";
                                            else 
                                                echo "redireccionar_actividades_calendario()";?>">
										<div class="tile-body">
											<i class="fa fa-calendar"></i>
										</div>
										<div class="tile-object">
											<div class="name">Calendario</div>
											<div class="number"></div>
										</div>
									</div>
									<div class="tile bg-red-sunglo" onclick="redireccionar_actividades_tabla();">
										<div class="tile-body">
											<i class="fa fa-gears"></i>
										</div>
										<div class="tile-object">
											<div class="name">Actividades</div>
											<div class="number"><?php echo get_cantidad_actividades();?></div>
										</div>
									</div>
									<div class="tile bg-blue-steel" onclick="redireccionar_caso_tabla();">
										<div class="tile-body">
											<i class="fa fa-gavel" ></i>
										</div>
										<div class="tile-object">
											<div class="name">Casos</div>
											<div class="number"><?php echo get_cantidad_casos($session_usu_id); ?></div>
										</div>
									</div>

									<div class="tile bg-green-meadow" onclick="redireccionar_cliente_tabla();">
										<div class="tile-body">
											<i class="fa fa-user" ></i>
										</div>
										<div class="tile-object">
											<div class="name">Clientes</div>
											<div class="number"><?php echo get_cantidad_clientes();?></div>
										</div>
									</div>

									<div class="tile bg-red-sunglo" onclick="redireccionar_dashboard_general();">
										<div class="tile-body">
											<i class="fa fa-bar-chart-o"></i>
										</div>
										<div class="tile-object">
											<div class="name">Reportes</div>
											<div class="number">1</div>
										</div>
									</div>

									<div class="tile bg-grey-steel">
										<div class="tile-body">
											<i class="fa fa-comments"></i>
										</div>
										<div class="tile-object">
											<div class="name">Mensajes</div>
											<div class="number">12</div>
										</div>
									</div>
									<div class="tile bg-grey-steel">
										<div class="tile-body">
											<i class="fa fa-fire-extinguisher"></i>
										</div>
										<div class="tile-object">
											<div class="name">Casos Complicados</div>
										</div>
									</div>
									<div class="tile bg-grey-steel">
										<div class="tile-body">
											<i class="fa fa-usd"></i>
										</div>
										<div class="tile-object">
											<div class="name">Ingresos</div>
											<div class="number">34</div>
										</div>

									</div>
									<div class="tile bg-grey-steel">
										<div class="tile-body">
											<i class="fa  fa-gear"></i>
										</div>
										<div class="tile-object">
											<div class="name">Configuración</div>
											<div class="number">34</div>
										</div>

									</div>
								</div>








							</div>
						</div>
						<!-- END EXAMPLE TABLE PORTLET-->
					</div>
				</div>
				<!-- END PAGE CONTENT INNER -->
			</div>
		</div>
		<!-- END PAGE CONTENT -->
	</div>
	<!-- END PAGE CONTAINER -->

	<!-- BEGIN PRE-FOOTER -->
<?php include("includes/prefooter.html")?>
<!-- END PRE-FOOTER -->
	<!-- BEGIN FOOTER -->
<?php include("includes/footer.html");?>
<!-- END FOOTER -->

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
function redireccionar_caso_tabla(cas_id){
	pagina = "caso_tabla.php";
	setTimeout(redireccionar, 100, pagina);	
}
function redireccionar_actividades_tabla(cas_id){
	pagina = "actividades_tabla.php";
	setTimeout(redireccionar, 100, pagina);	
}
function redireccionar_caso_actividades(cas_id){
	pagina = "caso_actividades_tabla.php?cas_id="+ cas_id;
	setTimeout(redireccionar, 100, pagina);	
}
function redireccionar_cliente_tabla(){
	pagina = "cliente_tabla.php";
	setTimeout(redireccionar, 100, pagina);	
}
function redireccionar_actividades_calendario(){
	pagina = "actividades_calendario.php";
	setTimeout(redireccionar, 100, pagina);	
}
function redireccionar_actividades_calendario_movil(){
	pagina = "actividades_calendario_movil.php";
	setTimeout(redireccionar, 100, pagina);	
}
function redireccionar_dashboard_general(){
	pagina = "dashboard_general.php";
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