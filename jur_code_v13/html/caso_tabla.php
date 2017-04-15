<?php include ("includes/title.php");?>
<?php include ("includes/security_session.php");?>
<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
<!--  BEGIN INCLUDE CLASSES -->
<?php include_once("../classes/class.casos.php");?>
<?php include_once("../classes/class.utiles.php");?>
<?php include_once("../classes/class.bd.php");?>
<!--  END INCLUDE CLASSES -->

<!--  BEGIN GLOBAL VARIABLES -->
<?php 
$session_usu_id= $_SESSION["usu_id"];
?>
<!--  END GLOBAL VARIABLES -->

<!--  BEGIN PHP FUNCTIONS -->
<?php 
function getExaTitle($exa_id){
    $class_utiles=new utiles();
    $r=getExaInfo($exa_id);
	$string.="<i style='font-size:20px;' class='icon-book-open'> ".$r["tye_name"]." ".$class_utiles->fecha_mysql_php($r["exa_date"])."</i>";
	$string.= " <i style='font-size:20px;' class='icon-clock'>  DEADLINE: ". $class_utiles->fecha_mysql_php($r["exa_deadlineshow"])."</i>";
	echo $string;	
}

function getExaState($exa_id){
    $class_exam=new Exam($exa_id);
    return($class_exam->getExa_status());
}
function getExaInfo($exa_id){
    $class_utiles=new utiles();
    $class_bd=new bd();
    $sql="SELECT * FROM Exam INNER JOIN TypeExam on Exam.tye_id=TypeExam.tye_id WHERE exa_id={$exa_id}";
    $resultado=$class_bd->ejecutar($sql);
    $r=$class_bd->retornar_fila($resultado);   
    return ($r);
}
function escribir_casos($session_usu_id){
    $class_bd=new bd();
    $class_utiles= new utiles();
    $sql="SELECT * FROM Casos 
            INNER JOIN Clientes on Casos.cli_id = Clientes.cli_id
            INNER JOIN Jurisdicciones on Casos.jur_id = Jurisdicciones.jur_id
            INNER JOIN Juzgados    on Casos.juz_id = Juzgados.juz_id
            INNER JOIN Materias    on Casos.mat_id = Materias.mat_id
            INNER JOIN EstadoCaso  on Casos.esc_id = EstadoCaso.esc_id
            INNER JOIN CompartirCasos on Casos.cas_id=CompartirCasos.cas_id 
          WHERE usu_id={$session_usu_id}";
    
    $resultado=$class_bd->ejecutar($sql);
    
    while ($r=$class_bd->retornar_fila($resultado))
    {
        if ($r["can_status"]==0)
            $color="#292829";
        if ($r["can_status"]==1)
            $color="#279DC1";
        if ($r["can_status"]==2)
            $color="#E45F87";
        
        $table="<tr style='cursor:pointer'>";
        $table.="<td onclick='redireccionar_caso_actividades({$r["cas_id"]})'; style='color:{$color};'>{$r["cas_id"]}</td>";
        $table.="<td onclick='redireccionar_caso_actividades({$r["cas_id"]})'; style='color:{$color};'>{$r["cas_legajo"]}</td>";
        $table.="<td onclick='redireccionar_caso_actividades({$r["cas_id"]})'; style='color:{$color};'>{$r["cas_legajo1"]}</td>";
        $table.="<td onclick='redireccionar_caso_actividades({$r["cas_id"]})'; style='color:{$color};'>{$r["cli_nombre"]} {$r["cli_apellido"]}</td>";
        $table.="<td onclick='redireccionar_caso_actividades({$r["cas_id"]})'; style='color:{$color};'>{$r["cas_caratula"]}</td>";
        $table.="<td onclick='redireccionar_caso_actividades({$r["cas_id"]})'; style='color:{$color};'>{$r["jur_nombre"]}</td>";
        $table.="<td onclick='redireccionar_caso_actividades({$r["cas_id"]})'; style='color:{$color};'>{$r["juz_nombre"]}</td>";
        $table.="<td onclick='redireccionar_caso_actividades({$r["cas_id"]})'; style='color:{$color};'>{$r["mat_nombre"]}</td>";
        $table.="<td onclick='redireccionar_caso_actividades({$r["cas_id"]})'; style='color:{$color};'>{$r["esc_nombre"]}</td>";
        $table.="<td onclick='redireccionar_caso_actividades({$r["cas_id"]})'; style='color:{$color};'>{$class_utiles->fecha_mysql_php($r["cas_fecha"])}</td>";
        $table.="<td onclick='redireccionar_caso_formulario({$r["cas_id"]})' style='color:{$color}; text-align: center;'><i style='font-size:15px;' class='icon-pencil'></td>";
        
        $table.="</tr>";

        echo $table;
        
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
				<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
				<div class="modal fade" id="portlet-config" tabindex="-1"
					role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"
									aria-hidden="true"></button>
								<h4 class="modal-title">Modal title</h4>
							</div>
							<div class="modal-body">Widget settings form goes here</div>
							<div class="modal-footer">
								<button type="button" class="btn blue">Save changes</button>
								<button type="button" class="btn default" data-dismiss="modal">Close</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
				<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
				<!-- BEGIN PAGE BREADCRUMB -->
        			<ul class="page-breadcrumb breadcrumb">
        				<li>
        					<a href="home.php">Retornar</a><i class="fa fa-circle"></i>
        				</li>
        				<li>
        					<a href="caso_formulario.php">Nuevo Caso</a>
        					
        				</li>
        				
        			</ul>
			<!-- END PAGE BREADCRUMB -->
				<!-- BEGIN PAGE CONTENT INNER -->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-cogs font-blue-sharp"></i> <span
										class="caption-subject font-blue-sharp bold uppercase">Tabla de Casos</span>
								</div>
								<div class="tools"></div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered table-hover"
									id="sample_1">
									<thead>
										<tr>
											<th>Id</th>
											<th>Id Carpeta</th>
											<th>Id Expediente</th>
											<th>Cliente</th>
											<th>Carátula</th>
											<th>Jurisdiccion</th>
											<th>Juzgado</th>
											<th>Materia</th>
											<th>Estado</th>
											<th>Inicio de Causa</th>
											<th>Ver/Mod.</th>
										</tr>
									</thead>
									<tbody>
            							<?php 
            							    escribir_casos($session_usu_id);	
            							?>
        							</tbody>
								</table>
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
function redireccionar_caso_formulario(cas_id){
	pagina = "caso_formulario.php?cas_id="+ cas_id;
	setTimeout(redireccionar, 100, pagina);	
}
function redireccionar_caso_actividades(cas_id){
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