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
<?php include_once("../classes/class.actividades.php");?>
<?php include_once("../classes/class.usuarios.php");?>
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
function getCasoInfo($cas_id){
    $class_bd=new bd();
    $sql="SELECT * FROM Casos 
          INNER JOIN Clientes on Casos.cli_id=Clientes.cli_id
          WHERE cas_id={$cas_id}";
    
    $resultado=$class_bd->ejecutar($sql);
    $r=$class_bd->retornar_fila($resultado);   
	$string.= " <i style='font-size:17px;' class='icon-user'>  Cliente: ". $r["cli_nombre"]." ".$r["cli_apellido"]."</i>";
	$string.=" <i style='font-size:10px;'> - ".$r["cas_caratula"]." - </i>";
	echo $string;	
}

function get_datos_usu_id($usu_id){
    $class_usuarios=new Usuarios($usu_id);
    $usu_apellido=$class_usuarios->getUsu_apellido();
    return ($usu_apellido);
}

function escribir_actividades($get_cas_id){
    $class_bd=new bd();
    $class_utiles= new utiles();
    $sql="SELECT * FROM Actividades 
            INNER JOIN TipoActividad on Actividades.tia_id = TipoActividad.tia_id
            INNER JOIN Usuarios      on Actividades.usu_idemisor = Usuarios.usu_id
          WHERE cas_id={$get_cas_id}";
    
    $resultado=$class_bd->ejecutar($sql);
    
    while ($r=$class_bd->retornar_fila($resultado))
    {
            if ($r["act_estado"]==0){
            $estado="Abierto";
            $color="";
            }
            if ($r["act_estado"]==1){
                $estado="Verificar";
                $color="#58b8a9";
            }
            if ($r["act_estado"]==2){
                $estado="Reveer";
                $color="#f36a5a";
            }
            if ($r["act_estado"]==3){
               $estado="Cerrado";
                $color="#292829";
            }
        $usu_apellido=get_datos_usu_id($r["usu_idresponsable"]);
        
 
        $fecha_modificacion=($r["act_fechacierre"]==NULL ? "" : $class_utiles->fecha_mysql_php_datetime($r["act_fechacierre"]));
        
        $table="<tr href='caso_actividades_modal.php?act_id={$r["act_id"]}&cas_id={$get_cas_id}' data-target='#ajax' data-toggle='modal' style='cursor:pointer'>";
        $table.="<td style='color:{$color};'>{$r["act_id"]}</td>";
        $table.="<td style='color:{$color};'>{$r["tia_nombre"]} {$r["cli_apellido"]}</td>";
        $table.="<td style='color:{$color};'>{$r["usu_apellido"]}</td>";
        $table.="<td style='color:{$color};'>{$usu_apellido}</td>";
        $table.="<td style='color:{$color};'>{$class_utiles->CortarTexto(stripslashes($r["act_comentario"]), 0,40)}...</td>";
        $table.="<td style='color:{$color};'>{$class_utiles->fecha_mysql_php_datetime($r["act_fecha"])}</td>";
        $table.="<td style='color:{$color};'>{$fecha_modificacion}</td>";
        $table.="<td style='color:{$color};'>{$estado}</td>";
        $table.="<td style='display:none;'>{$r["act_fecha"]}</td>";
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
		<div class="page-head">
			<div class="container">
				<!-- BEGIN PAGE TITLE -->
				<div class="page-title">
					<h1>
                        <?php getCasoInfo($get_cas_id);?>
					</h1>
				</div>
				<!-- END PAGE TITLE -->
				<!-- BEGIN PAGE TOOLBAR -->
				<div class="page-toolbar">
					<!-- BEGIN THEME PANEL -->
					<div class="btn-group btn-theme-panel">
						
					</div>
					<!-- END THEME PANEL -->
				</div>
				<!-- END PAGE TOOLBAR -->
			</div>
		</div>
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
        					<a href="caso_tabla.php">Retornar</a><i class="fa fa-circle"></i>
        				</li>
        				<li>
        					<a href='caso_actividades_modal.php?cas_id=<?php echo $get_cas_id;?>' data-target='#ajax' data-toggle='modal'>Nueva Actividad</a>
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
									<i class="fa fa-cogs font-green-sharp"></i> <span
										class="caption-subject font-green-sharp bold uppercase"> TABLA DE ACTIVIDADES DEL CASO ID - <?php echo  $get_cas_id;?></span>
								</div>
								<div class="tools"></div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered table-hover"
									id="sample_3">
									<thead>
										<tr>
											<th>Id Act</th>
											<th>Tipo Actividad</th>
											<th>Emisor</th>
											<th>Responsable</th>
											<th>Comentario</th>
											<th>Fecha Limite</th>
											<th>Ultima Modificación</th>
											<th>Estado</th>
											<th style="display:none;">Fecha Orden</th>
										</tr>
									</thead>
									<tbody>
            							<?php 
            							    escribir_actividades($get_cas_id);	
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
<script type="text/javascript"
	src="../../assets/global/plugins/moment.min.js"></script>
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